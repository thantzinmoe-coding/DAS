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

// Check if the id parameter is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input by converting to an integer

    // Prepare the DELETE query
    $deleteQuery = 'DELETE FROM doctor_hospital WHERE id = ?';
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('i', $id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the dashboard with a success message
        header('Location: /DAS/PHP/hospital_dashboard.php?message=Availability deleted successfully');
    } else {
        // Redirect back with an error message
        header('Location: /DAS/PHP/hospital_dashboard.php?error=Failed to delete availability');
    }

    $stmt->close();
} else {
    // If no id is provided, redirect with an error
    header('Location: /DAS/PHP/hospital_dashboard.php?error=No ID provided');
}

$conn->close();
?>