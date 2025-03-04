<?php
ob_start(); // Start output buffering
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensure JSON response

$response = ['success' => false]; // Default response

if (!isset($_SESSION['hospital_id'])) {
    $response['error'] = 'Not authorized';
    echo json_encode($response);
    ob_end_flush(); // Flush buffer and stop execution
    exit;
}

$request_id = $_POST['request_id'] ?? null;
if (!$request_id) {
    $response['error'] = 'No request ID provided';
    echo json_encode($response);
    ob_end_flush();
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    $response['error'] = 'Database connection failed';
    echo json_encode($response);
    ob_end_flush();
    exit;
}

// Prepare and execute query
$stmt = $conn->prepare('DELETE FROM emergency_requests WHERE id = ? AND hospital_id = ?');
if (!$stmt) {
    $response['error'] = 'Query preparation failed';
    echo json_encode($response);
    ob_end_flush();
    exit;
}

$stmt->bind_param('ii', $request_id, $_SESSION['hospital_id']);
$success = $stmt->execute();

if (!$success) {
    $response['error'] = 'Database operation failed: ' . $stmt->error;
} else {
    $response['success'] = true;
}

echo json_encode($response);

$stmt->close();
$conn->close();
ob_end_flush(); // End output buffering and send JSON
?>