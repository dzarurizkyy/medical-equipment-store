<?php  
  class AuthModel {
    private $db;

    // Tnitialize database connection
    public function __construct() {
      $this->db = new Database;
    }

    // To authenticate based on table, identifier, and data
    public function authentication($table, $identifier, $data) {
      $this->db->query("SELECT COUNT(*) as count FROM {$table} WHERE {$identifier}=:data");
      $this->db->bind(":data", $data);
      return $this->db->single()["count"];
    }

    // To register new user
    public function registration($data) {
      $this->db->query("INSERT INTO customer VALUES (
        '', :username, :password, :email, :birth, :gender, :address, :city, :phone_number
      )");

      $this->db->bind("username", $data["username"]);
      $this->db->bind("email", $data["email"]);
      $this->db->bind("password", $data["password"]);
      $this->db->bind("birth", $data["birth"]);
      $this->db->bind("gender", $data["gender"]);
      $this->db->bind("address", $data["address"]);
      $this->db->bind("city", $data["city"]);
      $this->db->bind("phone_number", $data["phone_number"]);

      $this->db->execute();
      return $this->db->rowCount();
    }

    // To get table data by username
    public function getByUser($table, $username){
      $this->db->query("SELECT * FROM {$table} WHERE username=:username");
      $this->db->bind("username", $username);
      return $this->db->single();
    }
  }
?>