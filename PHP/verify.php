<?php

header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set("display_errors", 1);

ob_start(); // Start buffering to prevent unwanted output
session_start();

$requestBody = file_get_contents("php://input");
$data = json_decode($requestBody, true);

if ($data["source"] === "verify") {
    $email = $data["email"];
    $otp = $data["otp"];
    $content = $data["content"];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "project";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        ob_end_clean(); // Remove unwanted output
        echo json_encode(["status" => "error", "message" => "Connection failed!"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT otp FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($otp_db);
    $stmt->fetch();

    ob_end_clean(); // Ensure JSON is the only output

    if ($otp == $otp_db) {
        $stmt = $conn->prepare("UPDATE users SET otp = 0, status = 'verified' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        echo json_encode(["status" => "success", "message" => "OTP verified!"]);

        ob_end_flush();

        require_once 'mail.php';
        if ($content !== "forget") {
            registerMail($email);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid OTP!"]);
    }
} else {
    ob_end_clean();
    echo json_encode(["status" => "error", "message" => "Invalid source!"]);
}
