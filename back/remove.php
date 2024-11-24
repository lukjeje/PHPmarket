<?php
session_start();

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // Loop through cart and remove item by name
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['name'] === $name) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
                echo 'Item removed successfully';
                exit();
            }
        }
    }
    echo 'Item not found in cart';
} else {
    echo 'Invalid request';
}
?>