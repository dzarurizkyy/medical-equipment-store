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
        $this->view("templates/footer");
      } else {
        // Redirect to auth page if not logged in
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    // To process checkout
    public function checkout() {
      // It updates order status to 'konfirmasi' and sets payment method.
      if(isset($_SESSION["user_id"]) && isset($_POST["checkout"])) {
        if($this->model("HomeModel")->checkout($_SESSION["user_id"], $_POST["checkout"]) > 0) {
          echo "<script>alert('Thank you for your order 😊!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home'</script>";
        } else {
          echo "<script>alert('Failed to process your order 😢!')</script>";
          echo "<script>window.location.href='" . BASEURL ."/home/cart'</script>";
        }
      } 
    }
  };
?>