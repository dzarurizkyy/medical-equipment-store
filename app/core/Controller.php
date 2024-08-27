<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  class Controller {
    // Render view with optional data
    public function view($view, $data = []) {
      require_once "../app/views/{$view}.php";
    }

    // Load and initialize instance model 
    public function model($model) {
      require_once "../app/models/{$model}.php";
      return new $model;
    }

    // Initialize Midtrans for payment processing
    public function midtrans() {
      return new Midtrans;
    }

    // Initialize PDF for document generation
    public function PDF() {
      return new \Mpdf\Mpdf();
    }

    // Initialize Mail for sending emails
    public function Mail() {
      return new PHPMailer(true);
    }
  }
?>