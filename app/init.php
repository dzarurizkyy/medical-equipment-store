<?php  
  // Import file
  require_once "config/config.php";
  require_once "core/App.php";
  require_once "core/Controller.php";
  require_once "core/Database.php";
  require_once "core/Payment.php";
  
  // Import package
  require_once __DIR__ . "/package/vendor/autoload.php";
  
  // Import helper
  require_once "helper/datetime.php";

  // Initialize application
  $app = new App;
?>