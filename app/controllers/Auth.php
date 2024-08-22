<?php 
  class Auth extends Controller {
    // Handle user login
    public function index() {
      $data["title"]          = "Login";
      $data["controller"]     = "auth/index";

      // Set session variables
      $_SESSION["cta"]        = "true";
      $_SESSION["register"]   = "true";

      $this->view("templates/header", $data);
      $this->view("auth/index", $data);
      $this->view("templates/footer");

      // Check if login form has been submitted
      if(isset($_POST["username"]) && isset($_POST["password"])) {
        // Authenticate user
        if($this->model("AuthModel")->authentication("customer", "username", $_POST["username"]) === 1) {
          $student = $this->model("AuthModel")->getByUser("customer", $_POST["username"]);
    
          // Verify password
          if(password_verify($_POST["password"], $student["password"])) {
            // Set session for successful login
            $_SESSION["login"] = "true";
            // Redirect to home page
            echo "<script>alert('Login success 😊!')</script>";
            echo "<script>document.location.href='" . BASEURL . "/home'</script>";
            return;
          } 
        } 

        // Alert for failed login
        echo "<script>alert('Login failed. Please try again later 😓!')</script>";
      }
    }

    // Handle user registration
    public function registration() {
      $data["title"] = "Registration";

      $this->view("templates/header", $data);
      $this->view("auth/registration");
      $this->view("templates/footer");

      // Check if registration form has been submitted
      if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
        // Check if username already exists
        if($this->model("AuthModel")->authentication("customer", "username", $_POST["username"]) === 1) {
          echo "<script>alert('Sorry, this username has already been taken 😓!')</script>";
          return;
        }
  
        // Check if passwords match
        if($_POST["password"] !== $_POST["confirm"]) {
          echo "<script>alert('Password and confirmation passsword does not match 😓!')</script>";
          return;
        }
      
        // Check if email already exists
        if($this->model("AuthModel")->authentication("customer", "email", $_POST["email"]) === 1) {
          echo "<script>alert('Sorry, this email has already been taken 😓!')</script>";
          return;
        }

        // Hash password
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
  
        // Attempt to register user
        if($this->model("AuthModel")->registration($_POST) > 0) {
          // Redirect to login page
          echo "<script>alert('Congratulations, your account has been successfully created 😊!')</script>";
          echo "<script>document.location.href='" . BASEURL ."/auth'</script>";
        }
      }
    }

    // Handle admin login
    public function admin() {
      $data["title"]         = "Login Admin";
      $data["controller"]    = "auth/admin";

      // Set session variables
      $_SESSION["cta"]       = "false";
      $_SESSION["register"]  = "false";

      $this->view("templates/header", $data);
      $this->view("auth/index", $data);
      $this->view("templates/footer");

      // Check if admin login form has been submitted
      if(isset($_POST["username"]) && isset($_POST["password"])) {
        // Authenticate admin
        if($this->model("AuthModel")->authentication("admin", "username", $_POST["username"]) === 1) {
          $admin = $this->model("AuthModel")->getByUser("admin", $_POST["username"]);

          // Verify admin password
          if(password_verify($_POST["password"], $admin["password"])) {
            // Set session for successful admin login
            $_SESSION["admin"] = "true";
            // Redirect to admin dashboard
            echo "<script>alert('Login success 😊!')</script>";
            echo "<script>document.location.href='" . BASEURL . "/admin'</script>";
            return;
          }
        }

        // Alert for failed admin login
        echo "<script>alert('Login failed. Please try again later 😓!')</script>";
      }
    }

    // Display registration link
    public function register() {
      if(isset($_SESSION["register"]) && $_SESSION["register"] === "true") {
        echo '
          <a href="' . BASEURL. '/auth/registration" class="text-secondary text-decoration-none mb-4">
            Don\'t have an account? Please <span class="fw-medium" style="color: #29978C;">registration</span> here
          </a>';
      }
    }
    
    // Display call-to-action for admin login
    public function CTA() {
      if(isset($_SESSION["cta"]) && $_SESSION["cta"] === "true") {
        echo '
          <a href="' . BASEURL . '/auth/admin" class="d-flex justify-content-center align-items-center col-lg-2 col-12 text-white p-2 gap-3 float-end text-decoration-none" style="background-color: #29978C; position: absolute; bottom: 0; right: 0px;">
            <div><i class="fa fa-vcard"></i></div>
            <small class="fw-semibold">Login as Admin</small>
          </a>';
      }
    }
  }
?>