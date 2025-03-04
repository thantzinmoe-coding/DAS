<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (!isset($_GET['doctor_id']) || empty($_GET['doctor_id'])) {
    die('Invalid doctor ID.');
}

$doctor_id = intval($_GET['doctor_id']);

// Delete doctor from the doctor_hospital table first
$deleteHospitalQuery = 'DELETE FROM doctor_hospital WHERE doctor_id = ?';
$stmt = $conn->prepare($deleteHospitalQuery);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();

// Delete doctor from the main doctors table
$deleteDoctorQuery = 'DELETE FROM doctors WHERE doctor_id = ?';
$stmt = $conn->prepare($deleteDoctorQuery);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();

echo "<script>alert('Doctor deleted successfully!'); window.location.href='/DAS/adminDashboard-hospital';</script>";

$conn->close();
?>