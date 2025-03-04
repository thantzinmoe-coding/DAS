<?php
// Database Connection
$servername = 'localhost';
$username = 'root';  // Change as needed
$password = '';  // Change as needed
$database = 'project';  // Change as needed

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Initialize variables
$hospital_id = '';
$hospital_name = '';
$doctors = [];

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $doctor_id = $_GET['delete_id'];

    // First, delete from doctor_hospital (if foreign key exists)
    $conn->query("DELETE FROM doctor_hospital WHERE doctor_id = $doctor_id");

    // Then, delete from doctor table
    $conn->query("DELETE FROM doctors WHERE doctor_id = $doctor_id");

    header('Location: ' . $_SERVER['PHP_SELF']);  // Redirect to refresh page
    exit;
}

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_doctor_id'])) {
    $edit_id = $_POST['edit_doctor_id'];
    $name = $_POST['name'];
    $job_type = $_POST['job_type'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $consultation_fee = $_POST['consultation_fee'];

    // Update doctor details
    $sql = 'UPDATE doctors SET name=?, job_type=?, gender=?, experience=?, consultation_fee=? WHERE doctor_id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssii', $name, $job_type, $gender, $experience, $consultation_fee, $edit_id);
    $stmt->execute();
    $stmt->close();
}

// Handle Hospital ID Input
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hospital_id'])) {
    $hospital_id = $_POST['hospital_id'];

    // Fetch hospital name
    $sql_hospital = 'SELECT name FROM hospitals WHERE hospital_id = ?';
    $stmt = $conn->prepare($sql_hospital);
    $stmt->bind_param('i', $hospital_id);
    $stmt->execute();
    $result_hospital = $stmt->get_result();
    if ($row = $result_hospital->fetch_assoc()) {
        $hospital_name = $row['name'];
    }

    // Fetch doctors for the selected hospital
    $sql = 'SELECT d.doctor_id, d.name, d.job_type, d.gender, d.experience, d.consultation_fee 
            FROM doctor_hospital dh
            JOIN doctors d ON dh.doctor_id = d.doctor_id
            WHERE dh.hospital_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $hospital_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="text-center mb-4">Search for Doctors in a Hospital</h2>

        <!-- Input Form to Enter Hospital ID -->
        <form method="post" class="text-center mb-4">
            <label for="hospital_id" class="form-label">Enter Hospital ID:</label>
            <input type="number" name="hospital_id" id="hospital_id" class="form-control w-50 mx-auto" required>
            <button type="submit" class="btn btn-primary mt-3">Search</button>
        </form>

        <?php if (!empty($hospital_name)): ?>
        <div class="hospital-header text-center bg-primary text-white p-2 mb-3">
            <h4><?php echo htmlspecialchars($hospital_name); ?></h4>
        </div>

        <?php if (!empty($doctors)): ?>
        <div class="row">
            <?php foreach ($doctors as $doctor): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($doctor['name']); ?></h5>
                        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($doctor['job_type']); ?></p>
                        <p><strong>Gender:</strong> <?php echo htmlspecialchars($doctor['gender']); ?></p>
                        <p><strong>Experience:</strong> <?php echo htmlspecialchars($doctor['experience']); ?> years</p>
                        <p><strong>Consultation Fee:</strong>
                            $<?php echo htmlspecialchars($doctor['consultation_fee']); ?></p>

                        <!-- Edit Button (Triggers Modal) -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editDoctorModal<?php echo $doctor['doctor_id']; ?>">Edit</button>

                        <!-- Delete Button -->
                        <a href="?delete_id=<?php echo $doctor['doctor_id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editDoctorModal<?php echo $doctor['doctor_id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Doctor Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="edit_doctor_id" value="<?php echo $doctor['doctor_id']; ?>">
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control"
                                    value="<?php echo htmlspecialchars($doctor['name']); ?>" required>

                                <label>Job Type:</label>
                                <input type="text" name="job_type" class="form-control"
                                    value="<?php echo htmlspecialchars($doctor['job_type']); ?>" required>

                                <label>Gender:</label>
                                <input type="text" name="gender" class="form-control"
                                    value="<?php echo htmlspecialchars($doctor['gender']); ?>" required>

                                <label>Experience (Years):</label>
                                <input type="number" name="experience" class="form-control"
                                    value="<?php echo htmlspecialchars($doctor['experience']); ?>" required>

                                <label>Consultation Fee ($):</label>
                                <input type="number" name="consultation_fee" class="form-control"
                                    value="<?php echo htmlspecialchars($doctor['consultation_fee']); ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>