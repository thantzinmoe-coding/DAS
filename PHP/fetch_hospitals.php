<?php
$host = "localhost";
$user = "root";
$password = ""; // Default for XAMPP
$dbname = "project";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';
$emergency = isset($_GET['emergency']) && $_GET['emergency'] == 'true' ? 1 : -1;

$sql = "SELECT * FROM hospitals WHERE 
        (name LIKE '%$search%' OR '$search' = '') AND
        (location LIKE '%$location%' OR '$location' = '') AND
        (specialty = '$specialty' OR '$specialty' = '')";

if ($emergency != -1) {
    $sql .= " AND emergency_services = $emergency";
}

$result = $conn->query($sql);

$hospitals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hospitals[] = $row;
    }
}

echo json_encode($hospitals);

$conn->close();
