<?php
include 'shared.php';
include '../includes/conn.php';
$conn = $pdo->open();
// header('Content-Type: application/json');
//   // retrieve JSON from POST body
//   $json_str = file_get_contents('php://input');
//   $json_obj = json_decode($json_str);
//     echo $json_obj;
// echo $total = $_POST['total'];

session_start(); // Added this line to start the session
// try {
//   $currency = "PHP";
//   $amount = $_SESSION['total_amount']; // Retrieve the total amount from the session
//   $paymentIntent = $stripe->paymentIntents->create([
//     'automatic_payment_methods' => ['enabled' => true],
//     'amount' => $amount * 100,
//     'currency' => $currency,
//   ]);
  
$stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user");
$stmt->execute(['user' => $_SESSION['user']]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['cart'] = array(); // Clear the existing cart items in the session

foreach ($cartItems as $item) {
    $product = [
        'cartid' => $item['cartid'],
        'productid' => $item['product_id'],
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'price' => $item['price'],
        // Add any other fields you need from the query result
    ];

    $_SESSION['cart'][] = $product; // Add the product to the session cart array
}

try {
  $currency = "PHP";
  $amount = $_SESSION['total_amount']; // Retrieve the total amount from the session

  $items = []; // Create an array to store the items

  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $row) {
      $item = [
        'name' => $row['name'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'currency' => $currency,
      ];

      $items[] = $item;
    }
  }
  
  $paymentIntent = $stripe->paymentIntents->create([
    'automatic_payment_methods' => ['enabled' => true],
    'amount' => $amount * 100,
    'currency' => $currency,
    'metadata' => [
      'items' => json_encode($items), // Add the items to the payment intent metadata
    ],
  ]);

// try {
//   $currency = "PHP";
//   $total = $_POST['total']; // Get the total amount from the request
//   $paymentIntent = $stripe->paymentIntents->create([
//     'automatic_payment_methods' => ['enabled' => true],
//     'amount' => $total * 100, // Convert the total amount to cents
//     'currency' => $currency,
//   ]);
  // $output = [
  //   'clientSecret' => $paymentIntent->client_secret,
  // ];
  // echo json_encode($output);


} catch (\Stripe\Exception\ApiErrorException $e) {
  if ($e->getError() && $e->getError()->message) {
    error_log($e->getError()->message);
  } else {
    error_log('Stripe API Error');
  }
  http_response_code(400);
  ?>
      <!DOCTYPE html>
      <html>
      <head>
      <style>
      body {
        background-color: #FEE2E2; /* Set the background color of the page */
      }

      .card {
        overflow: hidden;
        position: relative;
        background-color: #ffffff;
        text-align: left;
        border-radius: 0.5rem;
        max-width: 390px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        margin: 0 auto; /* Add this line to center the card horizontally */
        margin-top: 50vh; /* Add this line to center the card vertically */
        transform: translateY(-50%); /* Add this line to center the card vertically */
        font-family: "Palatino", sans-serif; /* Add this line to change the font */
      }

      .header {
        padding: 1.25rem 1rem 1rem 1rem;
        background-color: #ffffff;
      }

      .image {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        background-color: #FEE2E2;
        flex-shrink: 0;
        justify-content: center;
        align-items: center;
        width: 3rem;
        height: 3rem;
        border-radius: 9999px;
      }

      .image svg {
        color: #DC2626;
        width: 1.5rem;
        height: 1.5rem;
      }

      .content {
        margin-top: 0.75rem;
        text-align: center;
      }

      .title {
        color: #111827;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.5rem;
      }

      .message {
        margin-top: 0.5rem;
        color: #6B7280;
        font-size: 0.875rem;
        line-height: 1.25rem;
      }

      .actions {
        margin: 0.75rem 1rem;
        background-color: #F9FAFB;
      }

      .backToHome {
        display: inline-flex;
        padding: 0.5rem 1rem;
        background-color: #DC2626;
        color: #ffffff;
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        justify-content: center;
        width: 100%;
        border-radius: 0.375rem;
        border-width: 1px;
        border-color: transparent;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      }

      .cancel {
        display: inline-flex;
        margin-top: 0.75rem;
        padding: 0.5rem 1rem;
        background-color: #ffffff;
        color: #374151;
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        justify-content: center;
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #D1D5DB;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      }
      </style>
      </head><center>
      <div class="card">
        <div class="header">
          <div class="image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg></div>
          <div class="content">
            <span class="title">ERROR</span>
            <p class="message">We apologize for the inconvenience, but you cannot proceed with the payment as your cart is empty. Please add items to your cart before attempting to checkout.</p>
          </div>
          <div class="actions">
            <a href="/sia_final_project1/index.php"><button class="backToHome" type="button">Back to Home</button></a>
          </div>
        </div>
        </div>
        </center>
      </body>
      </html>
  <?php
  exit;
} catch (Exception $e) {
  error_log($e);
  http_response_code(500);
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Payment</title>
    <link href="../images/chandelier_logo.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://js.stripe.com/v3/"></script>
    <script src="./appearance3.js"></script>
    <script>


      document.addEventListener('DOMContentLoaded', async () => {
        const stripe = Stripe('<?= $_ENV["STRIPE_PUBLISHABLE_KEY"]; ?>', {
          apiVersion: '2022-11-15',
        });

        const elements = stripe.elements({
          clientSecret: '<?= $paymentIntent->client_secret; ?>', appearance
        });

        const linkAuthenticationElement = elements.create("linkAuthentication");
        linkAuthenticationElement.mount("#link-authentication-element");

        const addressElement = elements.create("address", {
        mode: "shipping",
        display: {
          name: "split",
        },
        onChange: (event) => {
          const firstName = event.value.firstName || "";
          const lastName = event.value.lastName || "";
          // Use the firstName and lastName values as needed
        },
      });
      addressElement.mount("#address-element");


        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');



        const paymentForm = document.querySelector('#payment-form');
        paymentForm.addEventListener('submit', async (e) => {
          // Avoid a full page POST request.
          e.preventDefault();

          // Disable the form from submitting twice.
          paymentForm.querySelector('button').disabled = true;

          // Confirm the card payment that was created server side:
          const {error} = await stripe.confirmPayment({
            elements,
            confirmParams: {
              return_url: `${window.location.origin}/sia_final_project1/public/return.php`
            }
          });
          if(error) {
            addMessage(error.message);

            // Re-enable the form so the customer can resubmit.
            paymentForm.querySelector('button').disabled = false;
            return;
          }
        });
      });
    </script>
  </head>
  <body style="background-color: #FEBD59;"> 
  <!-- #c1c9d2 -->
    <main>
    <center><img src="../images/chandelier_logo.png" alt="Logo" style="width: 150px; height: 150px;"></center>

      <form id="payment-form" style="background-color: #F5F1E8;">
      <center><label style="color: #00000; font-weight: bold; font-size: 22px; font-family: Palatino, sans-serif;" for="payment-element">Billing Details</label></center>
        <hr>
        <div id="link-authentication-element">
        <!--Stripe.js injects the Link Authentication Element-->
        </div>
        <div id="address-element">
        <!-- Elements will create form elements here -->
        </div>
        <div id="payment-element">
          <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="payment-errors" role="alert"></div>
        <button id="submit" style="width: 437px; background-color: green; color: white;">
        <i class="fas fa-money-check-alt"></i>
            Pay
          </button>
          <center>
          <button onclick="window.location.href='../cart_view.php'" style="width: 437px;">
          <i class="fas fa-arrow-left"></i> 
            Back
          </button>
          </center>
      </form>

      <div id="messages" role="alert" style="display: none;"></div>
    </main>
  </body>
</html>
