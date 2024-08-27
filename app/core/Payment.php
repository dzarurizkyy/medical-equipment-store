<?php  
    require_once __DIR__ . '/../package/vendor/midtrans/midtrans-php/Midtrans.php';

    class Midtrans {
        // To initialize Midtrans configuration
        public function __construct() {
            \Midtrans\Config::$serverKey = 'SB-Mid-server-dBw1NnXYfc7kGh8MNpg5xnBo';
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
        }

        // To generate Snap token for payment
        public function getSnapToken($params) {
            return \Midtrans\Snap::getSnapToken($params);
        }
    }
?>