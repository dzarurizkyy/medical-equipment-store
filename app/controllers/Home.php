<?php 
  class Home extends Controller {
    public function index() { 
      $data["title"] = "Beranda";
      
      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
          $this->view("templates/header", $data);
          $this->view("home/index");
          $this->view("templates/footer");
      } else {
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }

    public function detail() {
      $data["title"] = "Detail Produk";

      if(isset($_SESSION["login"]) && $_SESSION["login"] === "true") {
        $this->view("templates/header", $data);
        $this->view("home/detail");
        $this->view("templates/footer");
      } else {
        header("Location: " . BASEURL . "/auth");
        exit;
      }
    }
  };
?>