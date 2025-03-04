<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];

    require 'connection.php';
    $conn = connect();

    $sql = $conn->prepare("SELECT * FROM booking WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result) {
        $sql = $conn->prepare("INSERT INTO patients (doctor_id, patient_name, appointment_date, appointment_start_time, appointment_end_time, hospital_id, symptoms) VALUES (:doctor_id, :patient_name, :appointment_date, :appointment_start_time, :appointment_end_time, :hospital_id, :symptoms)");
        $sql->bindParam(':patient_name', $result['patient_name']);
        $sql->bindParam(':doctor_id', $result['doctor_id']);
        $sql->bindParam(':appointment_date', $result['appointment_date']);
        $sql->bindParam(':appointment_start_time', $result['appointment_start_time']);
        $sql->bindParam(':appointment_end_time', $result['appointment_end_time']);
        $sql->bindParam(':hospital_id', $result['hospital_id']);
        $sql->bindParam(':symptoms', $result['symptoms']);
        $sql->execute();

        $sql = $conn->prepare("DELETE FROM booking WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            echo json_encode(['status' => 'success' , 'message' => 'Appointment deleted successfully']);
        } else {
            echo json_encode(['status' => 'error' , 'message' => 'Failed to delete appointment']);
        }
    } else {
        echo json_encode(['status' => 'error' , 'message' => 'Appointment not found']);
    }
} else {
    echo json_encode(['status' => 'error' , 'message' => 'Invalid request method']);
}
