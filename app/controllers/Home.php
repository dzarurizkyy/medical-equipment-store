<?php 
  class Home extends Controller {
    // To handle home page
    public function index($param = "page", $value = 1, $param2 = "", $value2 = 0) {
      $data["title"] = "Home";
      
      // Handle pagination actions
      $total_data = 6;
      $total_row  = $this->model("HomeModel")->totalRow();
      $data["total_page"] = (int)ceil($total_row / $total_data);
      $data["active_page"] = $param === "page" ? (int)$value : 1;
      $formula = ($data["active_page"] * $total_data) - $total_data;
      
      if($param !== "category") {
        $data["products"] = $this->model("HomeModel")->pagination($formula, $total_data);
        $_SESSION["pagination"] = "true";
      }
        
      // Handle category filtering
      $category = $this->model("HomeModel")->getCategory();
      $data["category"] = ["newest", "oldest"];

      foreach($category as $item) {
        array_push($data["category"], strtolower($item["category"])); 
      }

      if($param === "category") {
        $_SESSION["pagination"] = "false";
        $value = ucwords(str_replace("-", " ", $value));
        $data["products"] = $this->model("HomeModel")->filter($value);
      } 
        
      // Handle cart actions
      if($param === "cart") {
        $data["product_id"] = $value;
      }

      if($param2 === "cart") {
        $data["product_id"] = $value2;
      }

      // Check if user is logged in before displaying page
      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbar");
        $this->view("home/index", $data);
        $this->view("templates/logout");
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    // To display product details
    public function detail($id) {
      $data["title"] = "Detail Product";
      $data["product"] = $this->model("HomeModel")->detail((int)$id);

      // Check if user is logged in before displaying page
      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbar");
        $this->view("home/detail", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    // To handle order actions
    public function order($id) {
      $stock = $this->model("HomeModel")->getStock($id)["stock"];
      $price = $this->model("HomeModel")->getStock($id)["price"];

      // Check if quantity is posted
      if(isset($_SESSION["user_id"]) && isset($_POST["quantity"])) {
        // Check if quantity is higher than available stock
        if($_POST["quantity"] > $stock) {
          echo "<script>alert('Quantity input higher than available stock product 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home'</script>";
        } else {
          if($this->model("HomeModel")->cart($_SESSION["user_id"], $id, $_POST["quantity"], $price) > 0) {
            echo "<script>alert('Product successfully added to your shopping cart 😊')</script>";
            echo "<script>window.location.href='" . BASEURL ."/home/cart'</script>";
          } else {
            echo "<script>alert('Product unsuccessfully added to your shopping cart 😊')</script>";
            echo "<script>window.location.href='" . BASEURL ."/home'</script>";
          }
        }
      }
    }

    // To get cart count
    public function totalCart($id) {
      if($cart = $this->model("HomeModel")->getTotalCart($id)) {
        return $cart;
      };
      
      return 0;
    }

    // To display pagination
    public function pagination($data) {
      if(isset($_SESSION["pagination"]) && $_SESSION["pagination"] === "true") {
        echo '
          <nav class="mt-3">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link text-light" href="' . BASEURL . '/home/index/page/' . ($data["active_page"] === 1 ? 1 : $data["active_page"] - 1) .'"  style="background-color: #29978C">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>';
              for($i = 1; $i <= $data["total_page"]; $i++) : 
                echo ' 
                  <li class="page-item">
                    <a class="page-link fw-semibold" href="' . BASEURL .'/home/index/page/' . $i . '" style="color: #6C757D">' . $i .'</a>
                  </li>'; 
              endfor;
          echo '
              <li class="page-item">
                <a class="page-link text-light" 
                  href="' . BASEURL . '/home/index/page/' . ($data["active_page"] === $data["total_page"] ? $data["total_page"] : $data["active_page"] + 1) . '" style="background-color: #29978C">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>';
      }
    }

    // To display cart details
    public function cart($param = "", $value = 0) {
      $data["title"]  = "Shopping Cart";
      $data["orders"] = $this->model("HomeModel")->getCart($_SESSION["user_id"]); 
      $data["total"]  = 0;
      
      if($param === "cancel") {
        if($this->model("HomeModel")->deleteCart($value) > 0) {
          echo "<script>alert('Product successfully remove from your shopping cart 😊!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home/cart'</script>";
        } else {
          echo "<script>alert('Product unsuccessfully remove from your shopping cart 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home'</script>";
        }
      }
      
      // Check if user is logged in before displaying page
      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbar");
        $this->view("home/cart", $data);

        if(isset($_SESSION["payment"]) && isset($_SESSION["token"]) && $_SESSION["payment"] === "debit") {
          $data["token"] = $_SESSION["token"];         
          unset($_SESSION["token"]);

          $this->view("home/payment", $data);
        }
        
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    // To handle payment process
    public function payment() {
      $user = $this->model("HomeModel")->getUserById($_SESSION["user_id"]);
      $orders = $this->model("HomeModel")->getCart($_SESSION["user_id"]);

      $_SESSION["payment"] = $_POST["checkout"];
      $_SESSION["total"] = $_POST["total"];

      // Check if user is logged in and payment method is selected
      if(isset($_SESSION["user_id"]) && isset($_POST["checkout"])) {
        // If payment method is debit, generate Snap token and proceed to cart
        if($_POST["checkout"] === "debit") {
          $items  = [];
          
          foreach($orders as $order) {
            $items[] = [
              "id" => $order["id"],
              "name" => $order["name"],
              "quantity" => $order["quantity"],
              "price" => $order["total"]
            ];
          }
  
          $params = [
            "transaction_details" => [
              "order_id" => rand(),
              "gross_amount" => $_POST["total"],
            ],
            "item_details" => $items,
            "customer_details" => [
              "first_name" => $user["username"],
              "email" => $user["email"],
              "phone" => $user["phone_number"]
            ]
          ];
          
          $_SESSION["token"] = $this->midtrans()->getSnapToken($params);
          $this->cart();
        } else {
          // If payment method is not debit, proceed to checkout
          $this->checkout();
        }
      }
    }

    // To process checkout
    public function checkout() {
      // It updates order status to 'konfirmasi' and sets payment method.
      if(isset($_SESSION["user_id"]) && isset($_SESSION["payment"])) {    
        $user = $this->model("HomeModel")->getUserById($_SESSION["user_id"]);
        $orders = $this->model("HomeModel")->getCart($_SESSION["user_id"]); 

        if($this->model("HomeModel")->checkout($_SESSION["user_id"], $_SESSION["payment"]) > 0) {
          $this->invoice($user, $orders);
        } else {
          echo "<script>alert('Failed to process your order 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home/cart'</script>";
        }
      } 
    }

    // To generate invoice
    public function invoice($user, $orders) {
      $date = date("d F Y", strtotime($orders[count($orders) - 1]["created_at"]));
      $service = $_SESSION["payment"] === "debit" ? "Midtrans" : "-";
      $payment = $_SESSION["payment"] ? ucfirst($_SESSION["payment"]) : "-";

      // Generate PDF documents
      $body = '
      <body style="font-family: arial;">
        <h2 style="text-align: center;">Toko Alat Kesehatan <br /> Laporan Belanja Anda </h2>
        <br />
        <table border="0" cellspacing="2" style="margin-left: auto; margin-right: auto;"> 
          <tr>
            <td>User ID<td>
            <td>:</td>
            <td>' . $user["id"] . '</td>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>Tanggal</td>
            <td>:</td>
            <td>' . $date . '</td>
          </tr>
          <tr>
            <td>Nama<td>
            <td>:</td>
            <td>' . $user["username"] . '</td>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>Layanan</td>
            <td>:</td>
            <td>' . $service . '</td>
          </tr>
          <tr>
            <td>Alamat<td>
            <td>:</td>
            <td>' . $user["address"] . '</td>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>Cara Bayar</td>
            <td>:</td>
            <td>' . $payment . '</td>
          </tr>
          <tr>
            <td>No Hp<td>
            <td>:</td>
            <td>' . $user["phone_number"] . '</td>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td>Status</td>
            <td>:</td>
            <td>Dalam Konfirmasi</td>
          </tr>
        </table>
        <br />
        <br />
        <table border="1" cellpadding="4" cellspacing="0" style="width: 100%">
          <tr>
            <th>No.</th>
            <th>Nama Produk dengan IDnya</th>
            <th>Jumlah</th>
            <th>Harga</th>
          </tr>
        ';
          foreach($orders as $index=>$order) :
            $body .= '
            <tr>
              <td style="text-align: center;">'. ++$index .'</td>
              <td>'. $order["name"] . ' (ID:' . $order["product_id"].')</td>
              <td style="text-align: center;">'. $order["quantity"] .'</td>
              <td>Rp'. $order["total"] .'</td>
            </tr>';
          endforeach;
      $body .=
        '</table>
          <p>Total Belanja : <b><u>Rp' . $_SESSION["total"] . '<u></b></p>
          <br/><br/>
          <div style="text-align: right">
            <img src="' . BASEURL . '/img/assets/Signature.png" width="100" style="margin-right: 60px;"/>
            <div><b><u>Dzaru Rizky Fathan Fortuna<b><u></div>
          </div>
      </body>';

      unset($_SESSION["payment"]);
      unset($_SESSION["total"]);

      $pdf = $this->PDF();
      $pdf->writeHTML($body);
      
      $uniq = "invoice-" . strtotime($orders[count($orders) - 1]['created_at']);
      $file = "./docs/invoices/{$uniq}.pdf";
      
      $pdf->output("{$file}", "F");
      
      // Send email to the customers
      $message = '
        <html>
          <head>
            <style type="text/css">
              body {
                font-family: Calibri;
                font-size: 16px;
                color: #000
              }
            </style>
          </head>
          <body>
            Dear <b>' . $user["username"] . '</b>, <br /><br />
            Berikut merupakan struk pembayaran terbaru anda <br />
            ---------------------------------------------- <br />
            Terima kasih telah berbelanja di toko kami 😊 
          </body>
        </html>
      ';

      $mail = $this->mail();
      $mail->CharSet = "UTF-8";
      $mail->IsMAIL();
      $mail->IsSMTP();
      $mail->SMTPDebug = 0; 
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl'; 
      $mail->Port = 465; 
      $mail->Host = 'smtp.gmail.com'; 
      $mail->Username = SMTPEMAIL; 
      $mail->Password = SMTPPASS; 
      $mail->Subject = "Struk Pembayaran Anda";
      $mail->From = "mail@tokoalatkesehatan.com";
      $mail->FromName = "Toko Alat Kesehatan";
      $mail->IsHTML(true);
      $mail->AddAddress("{$user['email']}");
      $mail->AddAttachment($file);
      $mail->MsgHTML($message);
      $mail->WordWrap = 50;
      $mail->Send();
      $mail->SmtpClose();

      if ($mail->isError()) {
        echo "<script>alert('Failed to send your invoice details to your email 😢!')</script>";
      } else {
        echo "<script>alert('Thank you for your order 😊!')</script>";
      }
      echo "<script>window.location.href='" . BASEURL ."/home'</script>";
    }

    // To display user profile
    public function profile() {
      $data["title"] = "Profile";
      $data["user"]  = $this->model("HomeModel")->getUserByID($_SESSION["user_id"]);

      // Check if user is logged in before displaying page
      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbar");
        $this->view("home/profile", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    // To display status user orders
    public function status($param = "", $value = 0) {
      $data["title"] = "Status";
      $data["orders"] = $this->model("HomeModel")->getStatus($_SESSION["user_id"]); 
      $data["total"]  = 0;

      // Cancel order and remove product from history orders
      if($param === "cancel") {
        if($this->model("HomeModel")->deleteCart($value) > 0) {
          echo "<script>alert('Order successfully cancelled 😊!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home/status'</script>";
        } else {
          echo "<script>alert('Order unsuccessfully cancelled 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home'</script>";
        }
      }

       // Check if user is logged in before displaying page
       if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbar");
        $this->view("home/status", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }
    
    // To submit feedback for an order
    public function submitFeedback() {
      if(isset($_POST)) {
        // Check if rating is within range 1 to 5
        if($_POST["rating"] > 5 || $_POST["rating"] < 1) {
          // If rating is not within range, display an alert and redirect to status page
          echo "<script>alert('Rating input only from 1 to 5 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL . "/home/status'</script>";
        }

        if($this->model("HomeModel")->feedback($_POST) > 0) {
          echo "<script>alert('Successfully submit your feedback! Thank you for your time 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL . "/home'</script>";
        } else {
          echo "<script>alert('Failed to submit your feedback. Please try again later 😢.')</script>";
          return;
        }
      }
    }

    // To check if feedback exists for an order
    public function existFeedback($order_id) {
      if ($this->model("HomeModel")->getTotalFeedback($order_id) === 1) {
        return 1;
      }
      return 0;
    }

    // To logout from user section
    public function logout() {
      session_unset();
      session_destroy();

      header("Location: " . BASEURL);
      exit;
    }
  };
?>