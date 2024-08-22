<?php
  // Check if session is not started, then start the session
  if(!session_id()) session_start();

  // Start application
  require_once "../app/init.php"; 
?>