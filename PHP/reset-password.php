<?php
header('Content-Type: application/json');
error_reporting(0); // Hide warnings and errors
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ?? '';
    $password = $_POST['password'] ?? '';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    require 'connection.php';
    $conn = connect();

    if ($conn == null) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed!']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET password = :hashed_password, otp = 0, status = 'verified' WHERE email = :email");
    $stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Password changed successfully!']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong!']);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Internal server error!']);
    exit;
}

?>