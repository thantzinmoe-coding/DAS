<?php

header('Content-Type: application/json');
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if ($email) {
        echo json_encode(['valid' => true, 'message' => $email]);
        require 'connection.php';
        $conn = connect();

        if ($conn == null) {
            echo json_encode(['status' => 'error', 'message' => 'Connection failed!']);
            exit;
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email,PDO::PARAM_STR);
        $stmt->execute();

        if(!$stmt->rowCount() > 0){
            ob_end_clean();
            echo json_encode(['valid' => false, 'message' => 'Email not found!']);
            exit;
        }

        $otp = random_int(100000, 999999);

        $stmt = $conn->prepare("UPDATE users SET otp = $otp, status = 'unverified' WHERE email = :email");
        $stmt->bindParam(':email', $email,PDO::PARAM_STR);
        $stmt->execute();

        if(!$stmt->rowCount() > 0){
            echo json_encode(['valid' => false, 'message' => 'Something went wrong!']);
            exit;
        }

        require_once 'send_mail.php';
        $_SESSION['content'] = "forget";
        if(!sendMail($email, $otp)){
            ob_end_clean();
            echo json_encode(['valid' => false, 'message' => 'Failed to send OTP!']);
            exit;
        }
        ob_end_clean();
        echo json_encode(['valid' => true, 'message' => 'OTP sent successfully to your email!']);
        
    } else {
        echo json_encode(['valid' => false, 'message' => $email]);
    }
}
