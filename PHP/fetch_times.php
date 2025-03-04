<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if (isset($_GET['hospital_id']) && isset($_GET['date']) && isset($_GET['doctor_id'])) {
    $hospital_id = intval($_GET['hospital_id']);
    $date = $_GET['date'];
    $doctor_id = intval($_GET['doctor_id']);
    // Convert the full date into a day name (ex: "MON")
    // $day = strtoupper(date('D', strtotime($date)));
    $day = strtoupper($_GET['day']);
    $times = [];

    // Only show times not already booked
    $sql = "SELECT available_time FROM doctor_hospital 
            WHERE hospital_id = ? AND doctor_id = ? AND available_day = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis",$hospital_id, $doctor_id, $day);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()){
        $times[] = $row['available_time'];
    }
    $stmt->close();
    $conn->close();
    echo json_encode($times);
} else {
    echo json_encode([]);
}
?>