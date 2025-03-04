<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = intval($_POST['doctor_id']);
    $hospital_id = intval($_POST['hospital_id']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patient_name = $_POST['patient_name'];
    $symptoms = $_POST['symptoms'];

    $sql = "INSERT INTO booking (doctor_id, hospital_id, appointment_date, appointment_time, patient_name, symptoms) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $doctor_id, $hospital_id, $date, $time, $patient_name, $symptoms);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    $stmt->close();
}
$conn->close();
?>
