<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// Get hospital_id from query parameter
$hospital_id = isset($_GET['hospital_id']) ? intval($_GET['hospital_id']) : 0;

// Fetch total count and details of emergency requests for this hospital
$total = $conn->query("SELECT COUNT(*) AS total FROM emergency_requests WHERE hospital_id = $hospital_id")->fetch_assoc()['total'];
$requests = [];
if ($total > 0) {
    $result = $conn->query("SELECT * FROM emergency_requests WHERE hospital_id = $hospital_id");
    while ($row = $result->fetch_assoc()) {
        $requests[] = [
            'id' => $row['id'],
            'patient_name' => htmlspecialchars($row['patient_name']),
            'symptoms' => htmlspecialchars($row['symptoms']),
            'division' => htmlspecialchars($row['division']),
            'township' => htmlspecialchars($row['township']),
            'street' => htmlspecialchars($row['street']),
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'submitted_at' => $row['submitted_at']
        ];
    }
}

$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(['total' => $total, 'requests' => $requests]);
?>