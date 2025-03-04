<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars($_POST['password']);

    if ($email !== false && !empty($password)) {
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

        // Check in users table
        $stmt = $conn->prepare("SELECT userID, password, status FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
            exit;
        }

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password, $status);
            $stmt->fetch();

            if ($status !== 'verified') {
                echo json_encode(['status' => 'verify', 'message' => 'Please verify your account first']);
                exit;
            }

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $id;
                echo json_encode(['status' => 'user', 'message' => 'Login successful']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
            }
        } else {
            // Check in doctors table
            $stmt->close();
            $stmt = $conn->prepare("SELECT doctor_id, password FROM doctors WHERE email = ?");
            if (!$stmt) {
                error_log("Prepare failed: " . $conn->error);
                echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
                exit;
            }

            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                error_log("Execute failed: " . $stmt->error);
                echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
                exit;
            }

            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['doctor_id'] = $id;
                    echo json_encode(['status' => 'doctor', 'message' => 'Login successful']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
                }
            } else {
                $stmt->close();

                $stmt = $conn->prepare("SELECT adminID, password, role, hospital_id FROM admins WHERE email = ?");
                if (!$stmt) {
                    error_log("Prepare failed: " . $conn->error);
                    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
                    exit;
                }

                $stmt->bind_param("s", $email);
                if (!$stmt->execute()) {
                    error_log("Execute failed: " . $stmt->error);
                    echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
                    exit;
                }

                $stmt->store_result();

                if($stmt->num_rows > 0){
                    $stmt->bind_result($id, $hashed_password, $role, $hospital_id);
                    $stmt->fetch();

                    if(password_verify($password, $hashed_password)){
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['loggedin'] = true;

                        if($role === 'hospital'){
                            $_SESSION['hospital_id'] = $hospital_id;
                        }
                        
                        echo json_encode(['status' => $role, 'message' => 'Login successful']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
                }
            }
        }
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    }
    exit;
}
