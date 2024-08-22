<?php 
  class Admin extends Controller {
    // Display admin dashboard
    public function index() {
      $data["title"] = "Dashboard";

      // Check if user is an admin
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] === "true") {
        $this->view("templates/header", $data);
        echo "Ini halaman admin";
        $this->view("templates/footer");
      } else {
        header("Location: ". BASEURL . "/auth/admin");
        exit;
      }
    }
  }
?>