<?php 
  class Admin extends Controller {
    // Display admin dashboard
    public function index($param = "", $value = 0) {
      $data["title"]  = "Dashboard";
      $data["orders"] = $this->model("AdminModel")->getOrder(); 
      
      // Handle display order details
      if($param === "view") {
        $data["order"] = $this->model("AdminModel")->getDetailOrder($value);
      }
      
      // Handle customer order approval
      if($param === "accept") {
        if($this->model("AdminModel")->updateStatusOrder($value, "disetujui") > 0) {
          echo "<script>alert('Order status successfully approved 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin'</script>";          
        } else {
          echo "<script>alert('Failed to approved order status 😢.')</script>";
        }
      }

      // Handle customer order cancellation
      if($param === "decline") {
        if($this->model("AdminModel")->updateStatusOrder($value, "dibatalkan") > 0) {
          echo "<script>alert('Order status successfully declined 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin'</script>";          
        } else {
          echo "<script>alert('Failed to declined order status 😢.')</script>";
        }
      }

      // Check if user is an admin
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/index", $data);
        $this->view("templates/footer");
      } else {
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }
    }

    // Display customer management page
    public function customer($param = "", $value = 0) {
      $data["title"] = "Product";
      $data["customer"] = $this->model("AdminModel")->getCustomer();

      // Check if user is an admin and display customer page if true
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/customer", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to admin login if not an admin
        header("Location : " . BASEURL . "/auth/admin");
        exit;
      }

      // Handle update customer data
      if($param === "update") {
        if($this->model("AdminModel")->updateCustomer($_POST) > 0) {
          echo "<script>alert('Customer data successfully updated 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/customer'</script>";
        } else {
          echo "<script>alert('Failed to update customer data 😢.')</script>";
        }
      }

      // Handle reset customer password
      if($param === "reset") {
        if(isset($_POST["password"])) {
          $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
          if($this->model("AdminModel")->changePassCustomer($_POST) > 0) {
            echo "<script>alert('Password customer successfully reset 😊.')</script>";
            echo "<script>window.location.href='" . BASEURL ."/admin/customer'</script>";
          } else {
            echo "<script>alert('Failed to reset password customer 😢.')</script>";
          }
        }
      }

      // Handle delete customer data
      if($param === "delete") {
        if($this->model("AdminModel")->deleteCustomer($value) > 0) {
          echo "<script>alert('Customer data successfully deleted 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/customer'</script>";
        } else {
          echo "<script>alert('Failed to delete customer data 😢.')</script>";
        }
      }
    }

    // Display supplier management page
    public function supplier($param = "", $value = 0) { 
      $data["title"] = "Supplier";
      $data["supplier"] = $this->model("AdminModel")->getSupplier();
      
      // Check if user is an admin and display supplier page if true
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/supplier", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to admin login if not an admin
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }

      // Handle add supplier data
      if($param === "add") {
        if(isset($_POST) && $this->model("AdminModel")->addSupplier($_POST) > 0) {
          echo "<script>alert('Supplier data successfully added 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/supplier'</script>";
        } else {
          echo "<script>alert('Failed to add supplier data 😢.')</script>";
        }
      }

      // Handle update supplier data
      if($param === "update") {
        if(isset($_POST) && $this->model("AdminModel")->updateSupplier($_POST) > 0) {
          echo "<script>alert('Supplier data successfully updated 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/supplier'</script>";
        } else {
          echo "<script>alert('Failed to update supplier data 😢.')</script>";
        }
      }

      // Handle delete supplier data
      if($param === "delete") {
        if($this->model("AdminModel")->deleteSupplier($value) > 0) {
          echo "<script>alert('Supplier data successfully deleted 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/supplier'</script>";
        } else {
          echo "<script>alert('Failed to delete supplier data 😢.')</script>";
        }
      }
    }

    // Display product management page
    public function product($param = "", $value = 0) {
      $data["title"]    = "Product";
      $data["product"]  = $this->model("AdminModel")->getProduct();
      $data["supplier"] = $this->model("AdminModel")->getSupplier();

       // Check if user is an admin and display product page if true
       if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/product", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to admin login if not an admin
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }

      // Handle add product data
      if($param === "add") { 
        if(isset($_POST) && $this->upload($_FILES) === true) {
          if($this->model("AdminModel")->addProduct($_POST) > 0) {
            echo "<script>alert('Product data successfully added 😊.')</script>";
            echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
          } else {
            echo "<script>alert('Failed to add product data 😢.')</script>";
          }
        }
      }

      // Handle update product data
      if($param === "update") {
        if(isset($_POST)) {
          if($this->upload($_FILES) === false) {
            $_POST["image"] = $_POST["image_name"];
          }

          if($this->model("AdminModel")->updateProduct($_POST) > 0) {
            echo "<script>alert('Product data successfully updated 😊.')</script>";
            echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
          } else {
            echo "<script>alert('Failed to update product data 😢.')</script>";
          }
        }
      }
      
      // Handle delete product data
      if($param === "delete") {
        if($this->model("AdminModel")->deleteProduct($value) > 0) {
          echo "<script>alert('Product data successfully deleted 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
        } else {
          echo "<script>alert('Failed to delete product data 😢.')</script>";
        }
      }
    }

    // Handle product image upload 
    public function upload($image) {
      if(isset($image["image"])) {
        $fileName     = $image["image"]["name"];
        $fileSize     = $image["image"]["size"];
        $fileTmp      = $image["image"]["tmp_name"];
        $error        = $image["image"]["error"];
        $formatFile   = explode(".", $fileName);

        // Check for error code 4 which means no file was uploaded
        if($error === 4) {
          echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
          return false;
        }

        // Check if file format is not jpg
        if(strtolower(end($formatFile)) !== "jpg") {
          echo "<script>alert('This file format is not supported. You can only upload jpg files 😇.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
          return false;
        }

        // Check if file size exceeds 2MB
        if($fileSize > 200000) {
          echo "<script>alert('This file is too large to be uploaded. You can only upload file maximum 2 MB 😇.');</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/product'</script>";
          return false;
        }

        // Generate unique name for the file
        $newFileName = uniqid();

        // Move uploaded file to products directory
        move_uploaded_file($fileTmp, "img/products/" . $newFileName . "." . end($formatFile));
        
        // Assign new file name to POST variable
        $_POST["image"] = $newFileName;

        // Return true indicating successful upload
        return true;
      }

      return false;
    }

    // Display feedback management page
    public function feedback($param = "", $value = 0) {
      $data["title"]    = "Feedback";
      $data["feedback"] = $this->model("AdminModel")->getFeedback();

      // Check if user is an admin and display feedback page if true
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/feedback", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to admin login if not an admin
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }

      // Handle delete feedback data
      if($param === "delete") {
        if(isset($_POST) && $this->model("AdminModel")->deleteFeedback($value) > 0) {
          echo "<script>alert('Feedback data successfully deleted 😊.')</script>";
          echo "<script>window.location.href='" . BASEURL ."/admin/feedback'</script>";
        } else {
          echo "<script>alert('Failed to delete feedback data 😢.')</script>";
        }
      }
    }

    // Display history order page
    public function history($param = "", $value = 8) {
      $data["title"] = "History";
      $data["history"] = $this->model("AdminModel")->getHistoryOrder();

      // Handle display history order details
      if($param === "view") {
        $data["detail"] = $this->model("AdminModel")->getDetailHistoryOrder($value);
      }
      
      // Check if user is an admin
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin");
        $this->view("admin/history", $data);
        $this->view("templates/footer");
      } else {
        // Redirect to admin login if not an admin
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }
    }
  }
?>