<?php  
  Class HomeModel {
    // Tnitialize database connection
    public function __construct() {
      $this->db = new Database;
    }
    
    // To get total number of rows in product table
    public function totalRow() {
      $this->db->query("SELECT COUNT(*) as count FROM product WHERE stock > 0");
      $this->db->execute();
      return $this->db->single()["count"];
    }

    // To get all categories from product table
    public function getCategory() {
      $this->db->query("SELECT DISTINCT category FROM product");
      $this->db->execute();
      return $this->db->resultSet();
    }
    
    // To get stock product
    public function getStock($id) {
      $this->db->query("SELECT stock FROM product WHERE id=:id");
      $this->db->bind("id", $id);
      return $this->db->single()["stock"];
    }
    
    // To get number of items in cart
    public function getCart($id) {
      $this->db->query("SELECT COUNT(*) as count FROM orders WHERE user_id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      return $this->db->single()["count"];
    }

    // To implement pagination for products
    public function pagination($start, $total) {
      $this->db->query("SELECT * FROM product WHERE stock > 0 ORDER BY name ASC LIMIT {$start}, {$total}");
      $this->db->execute();
      return $this->db->resultSet();
    }

    // To filter products based on category or sort by newest/oldest
    public function filter($category) {
      $query = "SELECT * FROM product WHERE stock > 0";
      
      if($category == "Newest" || $category == "Oldest") {
        $query .= " ORDER BY created_at";

        if ($category == "Newest") {
          $query .= " DESC";
        } else {
          $query .= " ASC";
        }

        $this->db->query($query);
      } 
      else {
        $query .= " AND category = :category";
        $this->db->query($query);
        $this->db->bind("category", $category);
      }

      return $this->db->resultSet();
    }

    // To get details product
    public function detail($id) {
      $this->db->query("SELECT * FROM product WHERE id=:id");
      $this->db->bind("id", $id);
      return $this->db->single();
    }
  }
?>