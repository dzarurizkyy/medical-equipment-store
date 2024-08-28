<?php  
  class AdminModel {
    // To initialize database connection
    public function __construct() {
      $this->db = new Database;
    }

    // To get all customers
    public function getCustomer() {
      $this->db->query("SELECT * FROM customer ORDER BY id DESC");
      $this->db->execute();
      return $this->db->resultSet();
    }
    
    // To update customer data
    public function updateCustomer($data) {
      $this->db->query(
        "UPDATE customer SET 
          username=:username, 
          email=:email, 
          birth=:birth, 
          gender=:gender,
          city=:city,
          phone_number=:phone_number,
          address=:address 
         WHERE id=:id");

      $this->db->bind("username", $data["username"]);
      $this->db->bind("email", $data["email"]);
      $this->db->bind("birth", $data["birth"]);
      $this->db->bind("gender", $data["gender"]);
      $this->db->bind("city", $data["city"]);
      $this->db->bind("phone_number", $data["phone"]);
      $this->db->bind("address", $data["address"]);
      $this->db->bind("id", $data["customer_id"]);
      $this->db->execute();

      return $this->db->rowCount();
    }

    // To change customer password
    public function changePassCustomer($data) {
      $this->db->query("UPDATE customer SET password=:password WHERE id=:id");
      $this->db->bind("id", $data["resetId"]);
      $this->db->bind("password", $data["password"]);
      $this->db->execute();

      return $this->db->rowCount();
    }

    // To delete customer
    public function deleteCustomer($id) {
      $this->db->query("DELETE FROM customer WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      return $this->db->rowCount();
    }
  }
?>