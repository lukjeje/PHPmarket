<?php
class Database {
    private $host = 'localhost'; // Change if your host is different
    private $db_name = 'items'; // Replace with your database name
    private $username = 'user'; // Replace with your database username
    private $password = 'password'; // Replace with your database password
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>