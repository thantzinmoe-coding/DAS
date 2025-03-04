<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
        exit();
    }

    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'project');

    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
    }

    // Update user data
    $stmt = $conn->prepare('UPDATE users SET username = ?, email = ? WHERE userID = ?');
    $stmt->bind_param('ssi', $username, $email, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
    }

    $stmt->close();
    $conn->close();
}
?>