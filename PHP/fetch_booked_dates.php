<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctor_id = $_GET['doctor_id'] ?? null;
    $hospital_id = $_GET['hospital_id'] ?? null;

    if (!$doctor_id || !$hospital_id) {
        echo json_encode(["error" => "Missing doctor_id or hospital_id"]);
        exit;
    }

    // Get already booked dates
    $query = "SELECT appointment_date FROM booking WHERE doctor_id = ? AND hospital_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $doctor_id, $hospital_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $booked_dates = [];
    while ($row = $result->fetch_assoc()) {
        $booked_dates[] = $row['appointment_date'];
    }
    $stmt->close();
    // Return available dates
    echo json_encode(['available_dates' => $booked_dates]);

    $conn->close();
} else {
    echo json_encode(['error' => 'An error occurred!']);
}
