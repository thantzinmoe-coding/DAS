<?php
require 'connection.php';
$conn = connect();

// For FormData with POST, use $_POST directly
$doctor_id = $_POST['doctor_id'] ?? null;

if ($doctor_id === null) {
    die("No doctor_id provided");
}

$sql = $conn->prepare("SELECT p.*, h.name AS hospital_name 
                      FROM patients p 
                      LEFT JOIN hospitals h ON p.hospital_id = h.hospital_id 
                      WHERE p.doctor_id = :doctor_id");
$sql->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
    echo "<td>" . htmlspecialchars($row['appointment_start_time']) . "</td>";
    echo "<td>" . htmlspecialchars($row['appointment_end_time']) . "</td>";
    echo "<td>" . htmlspecialchars($row['hospital_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['symptoms']) . "</td>";
    echo "</tr>";
}