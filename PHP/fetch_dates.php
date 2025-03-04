<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

$hospital_id = $_GET['hospital_id'];
$doctor_id = $_GET['doctor_id'];

$available_dates = [];
$booked_dates = [];
$today = date("D");

// Fetch available dates from the doctor_hospital table
$query = "SELECT available_day FROM doctor_hospital WHERE doctor_id = ? AND hospital_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $doctor_id, $hospital_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $available_dates[] = $row['available_day']; // This could be weekdays (e.g., 'Mon', 'Tue')
}

$stmt->close();
$conn->close();

// Return JSON response
echo json_encode(array_values($available_dates));
