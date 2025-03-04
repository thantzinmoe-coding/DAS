<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
}

// Check if a file is uploaded
if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid file upload.']);
    exit();
}
$uploadDir = 'uploads/';
$filename = time() . '_' . basename($_FILES['profile_image']['name']);
$targetFile = $uploadDir . $filename;

// Move the uploaded file
if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
    // Save just the filename in the database
    $stmt = $conn->prepare('UPDATE users SET profile_image = ? WHERE userID = ?');
    $stmt->bind_param('si', $filename, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'imagePath' => $targetFile]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
}

$conn->close();
?>