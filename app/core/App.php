<?php  
  class App {
    // Default variables
    private $controller = "home",
            $method     = "index",
            $params     = []; 

    // Constructor
    public function __construct() {
      // Determine controller, method, and parameters
      $url = $this->parseURL();

      // Check if the first part of the URL is a valid controller
      if(isset($url[0])) {
        if(file_exists("../app/controllers/". $url[0] . ".php")) {
          $this->controller = $url[0];
          unset($url[0]);
        }
      }

      // Include the controller file and create a new instance
      require_once "../app/controllers/{$this->controller}.php";
      $this->controller = new $this->controller;
      
      // Check if the second part of the URL is a valid method
      if(isset($url[1])) {
        if(method_exists($this->controller, $url[1])) {
          $this->method = $url[1];
          unset($url[1]);
        }
      }

      // Set the remaining parts of the URL as parameters
      if(!empty($url)) {
        $this->params = array_values($url);
      }

      // Call the controller method with the parameters
      call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse the URL and return its parts
    public function parseURL() {
      if(isset($_GET["url"])) {
        $url = rtrim($_GET["url"], "/");
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/", $url);
        return $url;
      }
    }
  }
?>  