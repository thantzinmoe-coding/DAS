<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');  // Ensure Burmese text support

// Handle Add & Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hospital'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $conn->real_escape_string($_POST['name']);
    $location = $conn->real_escape_string($_POST['location']);
    $specialty = $conn->real_escape_string($_POST['specialty']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $rating = isset($_POST['rating']) ? floatval($_POST['rating']) : null;
    $emergency_services = isset($_POST['emergency_services']) ? intval($_POST['emergency_services']) : 0;
    $uploadDir = 'uploads/';

    // Check if the upload directory exists, if not create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['profile_image']['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
        // Save just the filename in the database
        if ($id) {
            $sql = "UPDATE hospitals SET name='$name', location='$location', specialty='$specialty', contact='$contact', rating='$rating', emergency_services='$emergency_services' WHERE hospital_id=$id";
            $message = ($conn->query($sql) === TRUE) ? '✅ Hospital updated successfully!' : '❌ Error: ' . $conn->error;
        } else {
            $sql = "INSERT INTO hospitals (name, location, specialty, contact, rating, emergency_services, profile_image) VALUES ('$name', '$location', '$specialty', '$contact', '$rating', '$emergency_services', '$filename')";
            $message = ($conn->query($sql) === TRUE) ? '✅ Hospital added successfully!' : '❌ Error: ' . $conn->error;
        }
    }

    // **Prevent duplicate submission on refresh**
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM hospitals WHERE hospital_id=$id";
    $message = ($conn->query($sql) === TRUE) ? '✅ Hospital deleted successfully!' : '❌ Error: ' . $conn->error;

    // **Prevent duplicate deletion on refresh**
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Fetch Hospitals & Total Count
$result = $conn->query('SELECT * FROM hospitals');
$totalHospitals = $conn->query('SELECT COUNT(*) AS total FROM hospitals')->fetch_assoc()['total'];
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Hospitals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background: #007bff;
            color: white;
        }

        .btn-action {
            display: flex;
            gap: 10px;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            color: #2c3e50;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .icon-hospital {
            margin-right: 0.75rem;
            font-size: 2rem;
        }

        .dashboard-stats {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .hospital-count {
            padding: 0.75rem 1.25rem;
            font-size: 1.1rem;
            border-radius: 25px;
            background-color: #007bff;
            color: white;
            font-weight: 500;
        }

        .hospital-count strong {
            font-weight: 700;
            margin-left: 0.25rem;
        }

        .btn-back {
            background-color: #6c757d;
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .btn-back:hover {
            background-color: #5a6268;
            color: #fff;
            transform: translateX(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .btn-back .fas {
            transition: transform 0.3s ease;
        }

        .btn-back:hover .fas {
            transform: translateX(-4px);
        }
    </style>
</head>

<body>

    <div class="container" id="top">
        <div class="dashboard-header mb-4">
            <h2 class="dashboard-title">
                <span class="icon-hospital">🏥</span> Admin Dashboard
            </h2>
            <div class="dashboard-stats">
                <span class="hospital-count badge bg-primary">
                    Total Hospitals: <strong><?= $totalHospitals ?></strong>
                </span>
                <a href="/DAS/adminDashboard-system" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to System
                </a>
            </div>
        </div>

        <?php if (isset($message)) echo "<p class='alert alert-info text-center'>$message</p>"; ?>

        <div class="card p-4">
            <h4 class="mb-3">Add / Edit Hospital</h4>
            <form method="POST">
                <input type="hidden" id="id" name="id">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Hospital Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Specialty:</label>
                        <input type="text" class="form-control" id="specialty" name="specialty">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact:</label>
                        <input type="tel" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rating:</label>
                        <input type="number" class="form-control" id="rating" name="rating" step="0.1" min="0" max="5">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Services:</label>
                        <select class="form-control" id="emergency_services" name="emergency_services">
                            <option value="1">✅ Available</option>
                            <option value="0">❌ Not Available</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Hospital Profile Image:</label>
                        <input type="file" name="profile_image" class="form-control" required>
                    </div>
                </div>
                <button type="submit" name="submit_hospital" class="btn btn-success mt-3 w-100">Save Hospital</button>
            </form>
        </div>

        <h3 class="mt-4">Hospital List</h3>
        <table class="table table-striped fade-in">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Rating</th>
                    <th>Emergency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['hospital_id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= htmlspecialchars($row['contact']) ?></td>
                        <td><?= htmlspecialchars($row['rating']) ?></td>
                        <td>
                            <?= ($row['emergency_services'] == 1) ? '✅ Yes' : '❌ No' ?>
                        </td>
                        <td class="btn-action">
                            <a href="#top">
                                <button class="btn btn-warning btn-sm"
                                    onclick="editHospital(<?= htmlspecialchars(json_encode($row)) ?>)">✏️ Edit</button>
                            </a>
                            <a href="?delete=<?= $row['hospital_id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editHospital(hospital) {
            document.getElementById("id").value = hospital.hospital_id;
            document.getElementById("name").value = hospital.name;
            document.getElementById("location").value = hospital.location;
            document.getElementById("specialty").value = hospital.specialty;
            document.getElementById("contact").value = hospital.contact;
            document.getElementById("rating").value = hospital.rating;
            document.getElementById("emergency_services").value = hospital.emergency_services;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>