<?php
require_once 'connection.php';

class Hospital {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchAll() {
        $sql = "SELECT name, address, city, phone_number, email, website, established_date, type, created_at, updated_at FROM hospital";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>