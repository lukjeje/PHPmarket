<?php

require_once 'config.php';
session_start();
include("connect.php");

if(isset($_SESSION['email'])) {

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $productName = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $productPrice = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $productImg = isset($_POST['img']) ? htmlspecialchars($_POST['img']) : '';


    // Ensure the cart session variable is initialized
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to cart
    $_SESSION['cart'][] = array(
        'name' => $productName,
        'price' => $productPrice,
        'img' => $productImg
    );

    // Return a success response
    echo json_encode(array('status' => 'success', 'message' => 'Product added to cart.'));

} else {
    // Return an error response if not a POST request
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}

} else {
    echo("you need LogIn for it");
}

?>


