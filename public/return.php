<?php
require_once 'shared.php';

// Retrieve the payment intent from the query parameter
$paymentIntentId = $_GET['payment_intent'];
$paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

// Get the JSON data from the payment intent
// $jsonData = json_encode($paymentIntent, JSON_PRETTY_PRINT);

// Empty the cart after successful checkout or clicking the "Back" button
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Payment Intent</title>
  <link rel="stylesheet" href="css/success.css" />
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body style="background-color:#1A1F36;">
<main>

  <div class="card"> 
    <div class="header"> 
      <div class="image">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
      </div> 
      <div class="content">
        <span class="title">Transaction Succeeded</span> 
        <!-- <?php echo "<pre>$jsonData</pre>"; ?> -->
        <p class="message">Thank you for shopping with Chandelier. We appreciate your purchase. Your order receipt will be sent to your registered email address.</p> 
      </div> 
      <div class="actions">
        <a href="https://gmail.com/"><button class="history" type="button">View Email</button></a>
        <a href="/sia_final_project1/cart_clear.php"><button class="track" type="button">Back</button></a>
      </div> 
    </div> 
  </div>
</main>
</body>
</html>

