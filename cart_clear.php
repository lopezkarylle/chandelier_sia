<?php
session_start();
include 'includes/session.php';

// Clear the cart items
$_SESSION['cart'] = array();

// Clear the cart count in the navbar
$_SESSION['cart_count'] = 0;

// Delete all data from the cart table
$conn = $pdo->open();
try {
    $stmt = $conn->prepare("DELETE FROM cart");
    $stmt->execute();
} catch(PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}

$pdo->close();

// Redirect back to the cart page
header("Location: cart_view.php");
exit();
?>