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

    // To get all suppliers
    public function getSupplier() {
      // Query to retrieve all suppliers ordered by creation date in descending order
      $this->db->query("SELECT * FROM supplier ORDER BY created_at DESC");
      $this->db->execute();
      return $this->db->resultSet();
    }

    // To add new supplier
    public function addSupplier($data) {
      $created_at = datetime();

      $this->db->query("INSERT INTO supplier VALUES ('', :name, :email, :phone, :city, :address, :created_at)");

      $this->db->bind("name", $data["name"]);
      $this->db->bind("email", $data["email"]);
      $this->db->bind("phone", $data["phone"]);
      $this->db->bind("city", $data["city"]);
      $this->db->bind("address", $data["address"]);
      $this->db->bind("created_at", $created_at);

      $this->db->execute();
      return $this->db->rowCount();
    }
    
    // To update supplier data
    public function updateSupplier($data) {
      $this->db->query(
        "UPDATE supplier SET 
          name=:name, 
          email=:email,
          phone_number=:phone_number,
          city=:city,
          address=:address
         WHERE id=:id"
        );

      $this->db->bind("name", $data["name"]);
      $this->db->bind("email", $data["email"]);
      $this->db->bind("phone_number", $data["phone"]);
      $this->db->bind("city", $data["city"]);
      $this->db->bind("address", $data["address"]);
      $this->db->bind("id", $data["id"]);
      $this->db->execute();

      return $this->db->rowCount();
    }

    // To delete supplier
    public function deleteSupplier($id) {
      $this->db->query("DELETE FROM supplier WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      return $this->db->rowCount();
    }

    // To get all products
    public function getProduct() {
      $this->db->query(
        "SELECT 
          product.id, 
          product.image, 
          product.name,
          product.description, 
          product.category, 
          supplier.id as supplier_id,
          supplier.name as supplier_name, 
          product.stock, 
          product.price 
        FROM product 
        INNER JOIN supplier ON product.supplier_id = supplier.id 
        ORDER BY product.updated_at DESC;
      ");

      $this->db->execute();
      return $this->db->resultSet();
    }

    // To add new product
    public function addProduct($data) {
      $this->db->query("INSERT INTO product VALUES ('', :image, :name, :description, :category, :supplier_id, :stock, :price, :created_at, :updated_at)"
      );

      $date = datetime();

      $this->db->bind("image", $data["image"]);
      $this->db->bind("name", $data["name"]);
      $this->db->bind("description", $data["description"]);
      $this->db->bind("category", $data["category"]);
      $this->db->bind("supplier_id", $data["supplier_id"]);
      $this->db->bind("stock", $data["stock"]);
      $this->db->bind("price", $data["price"]);
      $this->db->bind("created_at", $date);
      $this->db->bind("updated_at", $date);

      $this->db->execute();
      return $this->db->rowCount();
    }

    // To update product data
    public function updateProduct($data) {
      $this->db->query(
        "UPDATE product SET
          name=:name,
          image=:image,
          description=:description,
          category=:category,
          supplier_id=:supplier_id,
          stock=:stock,
          price=:price
         WHERE id=:id 
      ");

      $this->db->bind("id", $data["id"]);
      $this->db->bind("name", $data["name"]);
      $this->db->bind("image", $data["image"]);
      $this->db->bind("description", $data["description"]);
      $this->db->bind("category", $data["category"]);
      $this->db->bind("supplier_id", $data["supplier_id"]);
      $this->db->bind("stock", $data["stock"]);
      $this->db->bind("price", $data["price"]);

      $this->db->execute();
      return $this->db->rowCount();
    }

    // To delete product
    public function deleteProduct($id) {
      $this->db->query("DELETE FROM product WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      
      return $this->db->rowCount();
    }
    
    // To get all feedbacks
    public function getFeedback() {
      $this->db->query(
        "SELECT 
          feedback.id, 
          customer.username as customer, 
          product.name as product, 
          feedback.rating, 
          feedback.message, 
          feedback.created_at 
        FROM feedback 
        INNER JOIN orders ON feedback.order_id=orders.id 
        INNER JOIN customer on orders.user_id = customer.id 
        INNER JOIN product ON orders.product_id=product.id
        ORDER BY feedback.created_at DESC;"
      );

      $this->db->execute();
      return $this->db->resultSet();
    }

    // To delete feedback
    public function deleteFeedback($id) {
      $this->db->query("DELETE FROM feedback WHERE id=:id");
      $this->db->bind("id", $id);
      $this->db->execute();
      return $this->db->rowCount();
    }
  }
?>