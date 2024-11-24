<?php
require_once 'back/config.php';
session_start();
include("back/connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="top-bar">
        <div class="left">
            <a href="index.php">Home</a>
            <a href="contact.html">Contact</a>
            </div>

     <div id="hh" style="text-align:center; padding:0%;"> <p  style="font-weight:bold;">
    
       <?php  
       
       if(isset($_SESSION['email'])) {

        $email=$_SESSION['email'];
        
        echo $email;
       }

       ?>
          
    </div>

        <div class="right">
            <a href="back/logout.php">Logout</a>
        </div>
    </div>


    
    <?php
session_start();

// Ensure the cart session variable is set
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $item) {
        $name = htmlspecialchars($item['name']);
        $price = htmlspecialchars($item['price']);
        $img = htmlspecialchars($item['img']);

        echo '<div class="product-box">';
        echo '    <div class="product-image">';
        echo '        <img src="' . $img . '" alt="Product Image">';
        echo '    </div>';
        echo '    <div class="product-info">';
        echo '        <h2 class="product-name">' . $name . '</h2>';
        echo '        <div class="amount-chooser">';
        echo '            <label for="quantity-' . $index . '">Quantity:</label>';
        echo '            <input type="number" id="quantity-' . $index . '" class="quantity-input" data-price="' . $price . '" min="1" value="1">';
        echo '        </div>';
        echo '        <p class="product-price" id="price-' . $index . '">$' . $price . '</p>';
        echo '        <button class="buy-button">Buy Now</button> <br>';
        echo '        <button onclick="remove(\'' . $name . '\')" class="remove-button">Remove</button>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p>No items in the cart.</p>';
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all quantity inputs
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    quantityInputs.forEach(input => {
        // Add event listener to each quantity input
        input.addEventListener('input', function() {
            const price = parseFloat(this.getAttribute('data-price'));
            const quantity = parseInt(this.value, 10);
            const totalPrice = price * quantity;
            
            // Find the corresponding price element and update its content
            const priceElement = document.getElementById('price-' + this.id.split('-')[1]);
            priceElement.textContent = '$' + totalPrice.toFixed(2);
        });
    });
});

function remove(Name) {
    alert('Removing item: ' + Name);
    
    $.ajax({
        url: 'back/remove.php',
        type: 'POST',
        data: { name: Name },

        success: function(response) {
          alert('Item removed successfully!');
          location.reload()
        },
        error: function(xhr, status, error) {
          alert('Error removing item: ' + error);
        }
    });
}

</script>




</body>
</html>