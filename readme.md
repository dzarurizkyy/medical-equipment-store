# Medical Equipment Store 💊👨‍⚕️
This is an e-commerce website designed for selling medical equipment online. The website is built using PHP follows MVC (Model-View-Controller) architecture.

## Getting Started 🚀

- <h3>Clone this repository</h3>
  
  ```
  git clone https://github.com/Dzaru-Portfolio/bnsp-project 
  ```
  
- <h3>Configure database</h3> 
  <p>Update your database configurations in app/config/config.php. Replace placeholders with your own database credentials</p>
  
  ```
  'baseurl' => 'http://localhost/bnsp-project/public'
  'dbhost'  => 'your_db_host',
  'dbuser'  => 'your_db_user',
  'dbname'  => 'your_db_name',
  'dbpass'  => 'your_db_password',
  ```
  
  
-  <h3>Register SMTP Email with Google</h3>
   <p>To enable email functionalities, you need to register SMTP email with Google.</p>
   
   - [Set up two factor authentication in Google](https://myaccount.google.com/two-step-verification/phone-numbers)
   - [Generate app password for your project](https://myaccount.google.com/apppasswords)
 
 -  <h3>Register with Midtrans</h3>
    <p>To enable payment functionalities, register Midtrans account and obtain your Client Key and Server Key.</p>

    - [Sign up for Midtrans account](https://dashboard.midtrans.com/register)
    - [Once registered, obtain your API credentials](https://www.youtube.com/watch?v=NsFfDrZ7hM8)
      
  - <h3>Run the Project</h3>

    ```
    http://localhost/bnsp-project/public
    ```

## Entity Relationship Diagram (ERD) 📊
  <p align="center">
    <img src="https://github.com/Dzaru-Portfolio/bnsp-project/blob/master/public/img/documentation/ERD.png">
  </p>

## Project Structure 🗂️
   
   ```
   project-root/
    ├── app/              # Contains core logic of MVC application
    |   ├── config/       # Configuration files (e.g., database settings)
    │   ├── controllers/  # Controllers that handle user requests and business logic
    │   ├── core/         # Core classes (e.g., base controller and model classes)
    │   ├── helpers/      # Helper functions for common tasks
    │   ├── models/       # Models for interacting with database
    │   ├── packages/     # Third-party packages (e.g., payment gateway integration)
    │   └── views/        # Views (HTML templates) for displaying content to user
    │
    ├── public/           # Publicly accessible files
    │   ├── css/          # Stylesheets for website
    │   ├── js/           # JavaScript files for interactivity
    │   └── img/          # Images used in website
    │
    └── index.php         # The main entry point for application
   ```
   
## Features 🔍
   - <h3>Visitor</h3>
     
     - Visit Site
     - Create New Account
     - Login
       
   - <h3>Customer</h3>
     
     - Browse Products by Category
     - Add/Remove Product from Cart
     - Payment (Cash/Debit)
     - Give Feedback
     - Logout

  - <h3>Admin</h3>
     
     - Manage Customer Database
     - Add/Remove/Update Product
     - Add/Remove/Update Supplier
     - View/Delete Order Feedback
     - Shipping Order
     - Logout

## Screenshots 📸
   - <h3>Visitor</h3>

     - Registration page
       <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Visitor-2.png" width="700"></p>
     - Login page
       <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Visitor-1.png" width="700"></p>
        
   - <h3>Customer</h3>

     - Home page
       <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Customer-1.png" width="700"></p>
     - Cart page
       <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Customer-2.png" width="700"></p>
     - Status page
       <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Customer-3.png" width="700"></p>
       
   - <h3>Admin</h3>
     
      - Product management page
        <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Admin-1.png" width="700"></p>
      - Customer management page
        <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Admin-2.png" width="700"></p>
      - Reset password page
        <p><img src="https://github.com/dzarurizkyy/medical-equipment-web/blob/master/public/img/documentation/Admin-3.png" width="700"></p>

## Contributor  🤝
   - [Dzaru Rizky Fathan Fortuna](https://www.linkedin.com/in/dzarurizky/)
       
