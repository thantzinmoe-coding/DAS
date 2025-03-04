<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = [];
if(isset($_GET['doctor_id']) && isset($_GET['hospital_id'])){
    $doctor_id = intval($_GET['doctor_id']);
    $hospital_id = intval($_GET['hospital_id']);

    $sql = "SELECT available_date, available_time FROM doctor_hospital WHERE doctor_id = ? AND hospital_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $doctor_id, $hospital_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    $stmt->close();
}
$conn->close();

echo json_encode($response);
?>
