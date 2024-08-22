<?php 
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
  }
?>