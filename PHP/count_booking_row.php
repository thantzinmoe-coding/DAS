<?php


header('Content-Type: application/json');
require_once 'connection.php';

$conn = connect();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $doctor_id = $_GET['doctor_id'] ?? null;
    $hospoital_id = $_GET['hospital_id'] ?? null;

    if(!$doctor_id || !$hospoital_id){
        echo json_encode(['error' => 'Missing doctor_id or hospital_id']);
        exit;
    }

    $query = "SELECT COUNT(*) as total FROM booking WHERE doctor_id = ? AND hospital_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(1, $doctor_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $hospoital_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['total' => $result['total']]);
    $conn = null;
} else {
    echo json_encode(['error' => 'An error occurred!']);
}

?>