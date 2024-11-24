<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
require_once 'back/config.php';
session_start();
include("back/connect.php");
?>

    <div class="top-bar">
        <div class="left">
            <a href="index.php">Home</a>
            <a href="contact.html">Contact</a>
        </div>
        <div class="right">
            <i class="fas fa-search"></i> <!-- Search icon -->
            <input type="text"  id="search-input" placeholder="Search...">
            <!-- Login and Sign Up buttons -->
            <a href="login.php" class="auth-button">Login</a>
            <a href="signup.php" class="auth-button">Sign Up</a>
        </div>
    </div>

    <?php  
    
    if(isset($_SESSION['email'])) {
        echo "<button onclick='home()' class='btn'>Cart <i class='fas fa-shopping-cart'></i> </button> <br> <br> <br>";
    } else {
    }
  

    ?>


<div class="container" id="items-container">

<?php

require_once 'back/Item.php';

// Create a database connection
$database = new Database();
$db = $database->connect();

// Create an Item object
$item = new Item($db);

// Fetch items
$result = $item->getItems();


// Check if there are any items
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($img) . '" alt="' . htmlspecialchars($name) . '">';
        echo '<h3>' . htmlspecialchars($name) . '</h3>';
        echo '<p>' . htmlspecialchars($info) . '</p>';
        echo '<p class="price">$' . htmlspecialchars($price) . '</p>';
        echo '<button class="buy-button" onclick="addToCart(\'' . htmlspecialchars($name) . '\', \'' . htmlspecialchars($price) . '\', \'' . htmlspecialchars($img) . '\')">Buy</button>';
        echo '</div>';
    }
} else {
    echo '<p>No items found.</p>';
}

?>

</div>

<script>

    $(document).ready(function(){
    $('#search-input').on('keyup', function() {
        let query = $(this).val();
        if (query !== '') {
            $.ajax({
                url: 'back/search.php',  // The PHP script that will fetch data
                method: 'POST',
                data: {query: query},
                success: function(data) {
                    $('#items-container').html(data);  // Update the HTML with the returned data
                }
            });
        } else {
            location.reload(); // Reload the page if the input is empty to show all items
        }
    });
});

function addToCart(Name, Price, Img) {

    $.ajax({
        url: 'back/add_to_cart.php',
        type: 'POST',
        data: {
            name: Name,
            price: Price,
            img: Img
        },
        success: function(response) {
          alert(response);
        }
    });

}

function home() {
            window.location.replace("http://192.168.5.11:8080/cart.php");
        }

</script>

</body>
</html>