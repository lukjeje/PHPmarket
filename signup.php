<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/login.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        </div>
    </div>

    <?php  
    
    if(isset($_SESSION['email'])) {
        echo "<button onclick='home()' class='btn'>Cart <i class='fas fa-shopping-cart'></i> </button>";
    } else {
    }
  

    ?>

    <div class="login-container">
        <h2>Signup</h2>
        <!-- Login form -->
        <form action="back/singup_process.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Signup</button>
        </form>
        <p>Don't have an account? <a href="login.php">Login up here</a>.</p>
    </div>


    <script>
        function home() {
            window.location.replace("http://192.168.5.11:8080/cart.php");
        }
    </script>
</body>
</html>