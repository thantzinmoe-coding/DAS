<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars($_POST['password']);
    $hospital_id = isset($_POST['hospitalID']) ? intval($_POST['hospitalID']) : null;
    $role = htmlspecialchars($_POST['role']);
    $name = htmlspecialchars($_POST['name']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connection.php';
    $conn = connect();

    if (!$conn) {
        echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    } else {
        $sql = "INSERT INTO admins (adminName, email, password, hospital_id, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $email, PDO::PARAM_STR);
        $stmt->bindValue(3, $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(4, $hospital_id, PDO::PARAM_INT);
        $stmt->bindValue(5, $role, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo json_encode(['status' => 'success', 'message' => 'Admin account created']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create admin account']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

?>