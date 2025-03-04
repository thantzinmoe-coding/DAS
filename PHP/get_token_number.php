<?php

require 'connection.php';

$conn = connect();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $doctor_id = $_GET['doctor_id'];
    $hospital_id = $_GET['hospital_id'];

    $stmt = $conn->prepare("SELECT token_number FROM booking WHERE doctor_id = :doctor_id AND hospital_id = :hospital_id");
    $stmt->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
    $stmt->bindParam(':hospital_id', $hospital_id, PDO::PARAM_INT);
    $stmt->execute();

    $token_number = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $token_number[] = $row['token_number'];
    }

    echo json_encode($token_number);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
}
