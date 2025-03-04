<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}

if (!isset($_POST['hospital_id']) || !isset($_POST['doctor_id']) || !isset($_POST['date'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit();
}

$hospital_id = intval($_POST['hospital_id']);
$doctor_id = intval($_POST['doctor_id']);
$date = $_POST['date'];

// Convert selected date to day of the week (e.g., "MON", "TUE", "WED")
$selected_day = strtoupper(date('D', strtotime($date)));

// Fetch available times for the selected day
$sql = "SELECT available_time FROM doctor_hospital WHERE hospital_id = ? AND doctor_id = ? AND available_day = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $hospital_id, $doctor_id, $selected_day);
$stmt->execute();
$result = $stmt->get_result();

$available_times = [];
while ($row = $result->fetch_assoc()) {
    $available_times[] = $row['available_time'];
}

$stmt->close();
$conn->close();

echo json_encode($available_times);
?>