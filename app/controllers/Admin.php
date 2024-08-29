<?php 
  class Admin extends Controller {
    // Display admin dashboard
    public function index() {
      $data["title"] = "Dashboard";

      // Check if user is an admin
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin", $data);
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
        $this->view("templates/navbarAdmin", $data);
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

    // Display feedback management page
    public function feedback($param = "", $value = 0) {
      $data["title"]    = "Feedback";
      $data["feedback"] = $this->model("AdminModel")->getFeedback();

      // Check if user is an admin and display feedback page if true
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        $this->view("templates/navbarAdmin", $data);
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
  }
?>