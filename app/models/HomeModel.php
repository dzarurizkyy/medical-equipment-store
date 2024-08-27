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
      $this->db->query("SELECT stock, price FROM product WHERE id=:id");
      $this->db->bind("id", $id);
      return $this->db->single();
    }
    
    // To get number of items in cart
    public function getTotalCart($id) {
      $this->db->query("SELECT COUNT(*) as count FROM orders WHERE user_id=:id AND status='keranjang'");
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

    // To add product to cart
    public function cart($user_id, $product_id, $quantity, $price) {
      // Set to the current time in Jakarta timezone
      $datetime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
      $created_at = $datetime->format("Y-m-d H:i:s");
    
      $this->db->query(
        "INSERT INTO orders (
            user_id, 
            product_id, 
            quantity,
            total, 
            status, 
            created_at
        ) VALUES (
            :user_id, 
            :product_id, 
            :quantity,
            :total, 
            'keranjang', 
            :created_at)
        ");
      
      $this->db->bind("user_id", $user_id);
      $this->db->bind("product_id", $product_id);
      $this->db->bind("quantity", $quantity);
      $this->db->bind("total", $price * $quantity);
      $this->db->bind("created_at", $created_at);
      $this->db->execute();
      
      return $this->db->rowCount();
    }

    // To get cart details
    public function getCart($user_id) {
      $this->db->query(
        "SELECT orders.id,
                product.id as product_id,
                product.image, 
                product.name,
                product.category,
                product.supplier, 
                orders.quantity, 
                orders.total, 
                orders.created_at 
        FROM orders 
        INNER JOIN product on orders.product_id=product.id 
        WHERE orders.user_id=:user_id AND orders.status = 'keranjang';"
      );

      $this->db->bind("user_id", $user_id);
      $this->db->execute();
      return $this->db->resultSet();
    }

    // To remove product from cart
    public function deleteCart($id) {
      $this->db->query("DELETE FROM orders WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      return $this->db->rowCount();
    }

    // To process checkout
    public function checkout($user_id, $payment) {
      $this->db->query(
          "UPDATE orders SET 
            status='konfirmasi', 
            payment=:payment 
          WHERE user_id=:user_id AND status='keranjang'
      ");

      $this->db->bind("user_id", $user_id);
      $this->db->bind("payment", $payment);
      $this->db->execute();

      return $this->db->rowCount();
    }

    // To get user details by ID
    public function getUserById($id) {
      $this->db->query("SELECT * FROM customer WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();

      return $this->db->single();
    }

    // To get order status by user ID
    public function getStatus($user_id) {
      $this->db->query(
        "SELECT orders.id,
                product.image,
                product.name,
                product.category,
                product.supplier,
                orders.quantity,
                orders.total,
                orders.status,
                orders.created_at
        FROM orders
        INNER JOIN product on orders.product_id=product.id
        WHERE orders.user_id=:user_id AND orders.status != 'keranjang' ORDER BY created_at DESC"
      );

      $this->db->bind("user_id", $user_id);
      $this->db->execute();

      return $this->db->resultSet();
    }

    // To submit feedback for an order
    public function feedback($data) {
      $created_at = datetime();

      $this->db->query("INSERT INTO feedback values ('', :order_id, :rating, :message, :created_at)");
      $this->db->bind("order_id", $data["order_id"]);
      $this->db->bind("rating", $data["rating"]);
      $this->db->bind("message", $data["message"]);
      $this->db->bind("created_at", $created_at);
      $this->db->execute();

      return $this->db->rowCount();
    }

    // To get total feedback for an order
    public function getTotalFeedback($order_id) {
      $this->db->query("SELECT COUNT(*) as count FROM feedback WHERE order_id=:order_id");
      $this->db->bind("order_id", $order_id);
      $this->db->execute();
      return $this->db->single()["count"];
    }
  }
?>