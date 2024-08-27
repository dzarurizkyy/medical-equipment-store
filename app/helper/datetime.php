<?php 
  // To get current datetime in Jakarta timezone
  function datetime() {
    $datetime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
    return $datetime->format("Y-m-d H:i:s");
  }
?>