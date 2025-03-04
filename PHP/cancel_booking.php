<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
}

// Get user email from session
$user_email = $_SESSION['email'];

// Get booking ID from the request
if (!isset($_POST['booking_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Booking ID is required.']);
    exit();
}

$booking_id = intval($_POST['booking_id']);  // Ensure it's an integer

// Delete the booking only if it belongs to the logged-in user
$stmt = $conn->prepare('DELETE FROM booking WHERE id = ? AND useremail = ?');
$stmt->bind_param('is', $booking_id, $user_email);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Booking successfully canceled.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to cancel booking.']);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>