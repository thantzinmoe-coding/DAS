<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access!"]);
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

// Check if the required fields are set
if (!isset($_POST['booking_id']) || !isset($_POST['new_date']) || !isset($_POST['new_time'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit();
}

$booking_id = intval($_POST['booking_id']);
$new_date = $_POST['new_date'];
$new_time = $_POST['new_time'];

// Check if booking exists
$checkStmt = $conn->prepare("SELECT id FROM booking WHERE id = ?");
$checkStmt->bind_param("i", $booking_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows === 0) {
    echo json_encode(["status" => "error", "message" => "Booking not found"]);
    exit();
}

// Update the appointment date and time
$updateStmt = $conn->prepare("UPDATE booking SET appointment_date = ?, appointment_start_time = ? WHERE id = ?");
$updateStmt->bind_param("ssi", $new_date, $new_time, $booking_id);

if ($updateStmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Appointment rescheduled successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to reschedule appointment"]);
}

$updateStmt->close();
$conn->close();
?>