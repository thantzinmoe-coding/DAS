<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: Sign_In.html');
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'project';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Ensure hospital_id is set
if (($_SERVER['REQUEST_METHOD'] !== 'GET') || !isset($_GET['doctor_id'])) {
    echo '<div class="container text-center mt-5">
        <h2>No Doctor Selected</h2>
        <p>Please select a doctor first.</p>
        <a href="/DAS/adminDashboard-hospital" class="btn btn-primary">Go Back</a>
    </div>';
    exit();
}

$doctor_id = $_GET['doctor_id'];

// Fetch all appointments for doctors in the hospital
$query = '
    SELECT b.id, b.appointment_date, b.appointment_start_time, b.appointment_end_time,
           b.patient_name, b.useremail, b.symptoms, d.name AS doctor_name
    FROM booking b
    JOIN doctors d ON b.doctor_id = d.doctor_id
    WHERE d.doctor_id = ?
    ORDER BY b.appointment_date DESC, b.appointment_start_time ASC';

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 1000px;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">📅 Hospital Admin - View Appointments</h2>

        <?php if ($result->num_rows > 0): ?>
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Doctor</th>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Appointment Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Symptoms</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['useremail']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_start_time']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_end_time']) ?></td>
                        <td><?= htmlspecialchars($row['symptoms']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-center text-muted">No appointments found.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="hospital_dashboard.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        </div>
    </div>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>