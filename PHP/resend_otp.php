<?php

header('Content-Type: application/json');
ob_start();
session_start();

$data = json_decode(file_get_contents("php://input"), true);

// Debugging
error_log(print_r($data, true)); // Check if JSON is received correctly
file_put_contents('debug.txt', json_encode($data)); // Log request data

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON data received"]);
    exit;
}

$email = $data['email'];
$otp = $data['otp'];

include 'connection.php';
$conn = connect();

if ($conn == null) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed!']);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET otp = :otp WHERE email = :email");
$stmt->bindValue(':otp', $otp, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    require_once 'send_mail.php';
    if(!sendMail($email, $otp)){
        ob_end_clean();
        echo json_encode(['status' => 'error', 'message' => 'Error sending mail']);
        exit;
    }
    ob_end_clean();
    echo json_encode(['status' => 'success', 'message' => 'OTP sent successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred!']);
}
