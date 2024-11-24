<?php
require_once 'Database.php';

class Item {
    private $conn;
    private $table = 'items';

    public $img;
    public $name;
    public $info;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getItems() {
        $query = "SELECT img, name, info, price FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>