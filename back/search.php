<?php
require_once 'Item.php';

$database = new Database();
$db = $database->connect();
$item = new Item($db);

// Check if the 'query' parameter is set and not empty
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $searchQuery = htmlspecialchars($_POST['query']);
    $stmt = $db->prepare("SELECT img, name, info, price FROM items WHERE name LIKE :query");
    $stmt->execute(['query' => '%' . $searchQuery . '%']);

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo '<div class="card">';
            echo '<img src="' . htmlspecialchars($img) . '" alt="' . htmlspecialchars($name) . '">';
            echo '<h3>' . htmlspecialchars($name) . '</h3>';
            echo '<p>' . htmlspecialchars($info) . '</p>';
            echo '<p class="price">$' . htmlspecialchars($price) . '</p>';
            echo '<button class="buy-button">Buy</button>';
            echo '</div>';
        }
    } else {
        echo '<p>No items found.</p>';
    }
} else {
    echo '<p>No search query provided.</p>';
}
?>