<?php

header('Content-Type: application/json');
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_time = microtime(true);

    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars($_POST['password']);
    $otp = filter_var($_POST['otp'], FILTER_VALIDATE_INT);

    if (!empty($username) && $email !== false && !empty($password) && strlen($password) >= 8) {
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "project";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
            echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
            exit;
        }

        error_log("Database connection established in " . (microtime(true) - $start_time) . " seconds");

        $stmt = $conn->prepare("SELECT userID FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'User already exists']);
            $stmt->close();
            $conn->close();
            exit;
        }

        $stmt->close();

        error_log("User existence check completed in " . (microtime(true) - $start_time) . " seconds");

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $status = "unverified";

        $stmt = $conn->prepare("INSERT INTO users (username, email, password, otp, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $hashed_password, $otp, $status);
        if ($stmt->execute()) {
            $id = $conn->insert_id;
            require 'send_mail.php';
            if(sendMail($email, $otp)) {
                ob_end_clean();
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $id;
                echo json_encode(['status' => 'success', 'message' => 'Please verify your account!']);
            } else {
                ob_end_clean();
                echo json_encode(['status' => 'error', 'message' => 'Failed to send verification email']);
            }
        } else {
            error_log("Error: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();

        error_log("Account creation completed in " . (microtime(true) - $start_time) . " seconds");
    } else {
        session_start();
        $_SESSION['message'] = 'Failed to create account';
        $error_message = 'Invalid input data';
        if (strlen($password) < 8) {
            $error_message = 'Password must be at least 8 characters long';
        }
        echo json_encode(['status' => 'error', 'message' => $error_message]);
    }

    error_log("Total script execution time: " . (microtime(true) - $start_time) . " seconds");
    exit;
}

?>