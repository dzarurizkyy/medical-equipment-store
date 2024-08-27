<script>
  // To process payment using Midtrans
  window.snap.pay(<?= json_encode($data["token"]) ?>, {
    // If payment is successful, it will redirect to checkout page
    onSuccess: function(result) {
     window.location.href= "<?= BASEURL ?>/home/checkout"
    },
    // If payment fails, it will show an alert message
    onError: function(result) {
      alert('Failed to process your order 😢!');
    }
  })</script>