<?php
require 'connection.php';
$conn = connect();

// Access data from $_POST instead of php://input
$hospital_id = $_POST['hospital_id'] ?? null;
$doctor_id = $_POST['doctor_id'] ?? null;

if ($hospital_id === null) {
    die("Error: hospital_id is required");
}
// Commenting out doctor_id check since it's not sent in JS yet
if ($doctor_id === null) {
    die("Error: doctor_id is required");
}

$sql = $conn->prepare("SELECT * FROM booking WHERE hospital_id = :hospital_id AND doctor_id = :doctor_id");
$sql->bindParam(':hospital_id', $hospital_id, PDO::PARAM_INT);
$sql->bindParam(':doctor_id', $doctor_id, PDO::PARAM_INT);
$sql->execute();
$appointments = $sql->fetchAll(PDO::FETCH_ASSOC);

if (empty($appointments)) {
    echo "<tr><td colspan='3'>No appointments found</td></tr>";
} else {
    foreach ($appointments as $appointment) {
        echo "<tr>";
        echo "<td class='text-start'>" . htmlspecialchars($appointment['patient_name']) . "</td>";
        echo "<td class='text-start'>" . htmlspecialchars($appointment['appointment_start_time']) . " - " . htmlspecialchars($appointment['appointment_end_time']) . "</td>";
        echo "<td class='text-start'>
                <div class='appointment-actions'>
                    <button class='btn btn-success btn-sm done-btn'>Done</button>
                </div>
              </td>";
        echo "</tr>";
    }
}
?>