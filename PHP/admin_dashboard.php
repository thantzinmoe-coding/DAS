<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');  // Ensure Burmese text support

// Handle Add & Update for Hospitals
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_hospital'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $conn->real_escape_string($_POST['name']);
    $location = $conn->real_escape_string($_POST['location']);
    $specialty = $conn->real_escape_string($_POST['specialty']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $rating = isset($_POST['rating']) ? floatval($_POST['rating']) : null;
    $emergency_services = isset($_POST['emergency_services']) ? intval($_POST['emergency_services']) : 0;

    if ($id) {
        $sql = "UPDATE hospitals SET name='$name', location='$location', specialty='$specialty', contact='$contact', rating='$rating', emergency_services='$emergency_services' WHERE hospital_id=$id";
        $message = ($conn->query($sql) === TRUE) ? '✅ Hospital updated successfully!' : '❌ Error: ' . $conn->error;
    } else {
        $sql = "INSERT INTO hospitals (name, location, specialty, contact, rating, emergency_services) VALUES ('$name', '$location', '$specialty', '$contact', '$rating', '$emergency_services')";
        $message = ($conn->query($sql) === TRUE) ? '✅ Hospital added successfully!' : '❌ Error: ' . $conn->error;
    }

    // Prevent duplicate submission on refresh
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Handle Add & Update for Doctors
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_doctor'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $job_type = $conn->real_escape_string($_POST['job_type']);
    $credential = $conn->real_escape_string($_POST['credential']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $consultation_fee = floatval($_POST['consultation_fee']);
    $profile = $conn->real_escape_string($_POST['profile']);
    $profile_image = $conn->real_escape_string($_POST['profile_image']);
    $experience = $conn->real_escape_string($_POST['experience']);

    if ($id) {
        $sql = "UPDATE doctors SET name='$name', email='$email', password='$password', job_type='$job_type', credential='$credential', gender='$gender', consultation_fee='$consultation_fee', profile='$profile', profile_image='$profile_image', experience='$experience' WHERE doctor_id=$id";
        $message = ($conn->query($sql) === TRUE) ? '✅ Doctor updated successfully!' : '❌ Error: ' . $conn->error;
    } else {
        $sql = "INSERT INTO doctors (name, email, password, job_type, credential, gender, consultation_fee, profile, profile_image, experience) VALUES ('$name', '$email', '$password', '$job_type', '$credential', '$gender', '$consultation_fee', '$profile', '$profile_image', '$experience')";
        $message = ($conn->query($sql) === TRUE) ? '✅ Doctor added successfully!' : '❌ Error: ' . $conn->error;
    }

    // Prevent duplicate submission on refresh
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Handle Delete for Hospitals
if (isset($_GET['delete_hospital'])) {
    $id = $_GET['delete_hospital'];
    $sql = "DELETE FROM hospitals WHERE hospital_id=$id";
    $message = ($conn->query($sql) === TRUE) ? '✅ Hospital deleted successfully!' : '❌ Error: ' . $conn->error;

    // Prevent duplicate deletion on refresh
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Handle Delete for Doctors
if (isset($_GET['delete_doctor'])) {
    $id = $_GET['delete_doctor'];
    $sql = "DELETE FROM doctors WHERE doctor_id=$id";
    $message = ($conn->query($sql) === TRUE) ? '✅ Doctor deleted successfully!' : '❌ Error: ' . $conn->error;

    // Prevent duplicate deletion on refresh
    header('Location: /DAS/adminDashboard-system');
    exit();
}

// Fetch Hospitals & Total Count
$hospitals = $conn->query('SELECT * FROM hospitals');
$totalHospitals = $conn->query('SELECT COUNT(*) AS total FROM hospitals')->fetch_assoc()['total'];

// Fetch Doctors & Total Count
$doctors = $conn->query('SELECT * FROM doctors');
$totalDoctors = $conn->query('SELECT COUNT(*) AS total FROM doctors')->fetch_assoc()['total'];

// Fetch Emergency Requests & Total Count
$emergencyRequests = $conn->query('SELECT * FROM emergency_requests');
$totalEmergencyRequests = $conn->query('SELECT COUNT(*) AS total FROM emergency_requests')->fetch_assoc()['total'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Hospitals & Doctors</title>
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
        animation: fadeIn 0.5s ease-in-out;
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
    </style>
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🏥 Admin Dashboard</h2>
            <div>
                <span class="badge bg-primary p-3 fs-6 me-2">Total Hospitals: <b><?= $totalHospitals ?></b></span>
                <span class="badge bg-success p-3 fs-6 me-2">Total Doctors: <b><?= $totalDoctors ?></b></span>
                <span class="badge bg-danger p-3 fs-6" data-bs-toggle="modal" data-bs-target="#emergencyModal"
                    style="cursor: pointer;" id="emergencyBadge">Emergency Requests: <b
                        id="emergencyCount"><?= $totalEmergencyRequests ?></b></span>
            </div>
        </div>

        <?php if (isset($message)) echo "<p class='alert alert-info text-center'>$message</p>"; ?>

        <!-- Hospital Form -->
        <div class="card p-4 mb-4">
            <h4 class="mb-3">Add / Edit Hospital</h4>
            <form method="POST">
                <input type="hidden" id="hospital_id" name="id">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Hospital Name:</label>
                        <input type="text" class="form-control" id="hospital_name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location:</label>
                        <input type="text" class="form-control" id="hospital_location" name="location" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Specialty:</label>
                        <input type="text" class="form-control" id="hospital_specialty" name="specialty">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact:</label>
                        <input type="tel" class="form-control" id="hospital_contact" name="contact" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rating:</label>
                        <input type="number" class="form-control" id="hospital_rating" name="rating" step="0.1" min="0"
                            max="5">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Services:</label>
                        <select class="form-control" id="hospital_emergency_services" name="emergency_services">
                            <option value="1">✅ Available</option>
                            <option value="0">❌ Not Available</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="submit_hospital" class="btn btn-success mt-3 w-100">Save Hospital</button>
            </form>
        </div>

        <!-- Doctor Form -->
        <div class="card p-4 mb-4">
            <h4 class="mb-3">Add / Edit Doctor</h4>
            <form method="POST" enctype="multipart/form-data">
                <!-- Add enctype for file uploads -->
                <input type="hidden" id="doctor_id" name="id">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Doctor Name:</label>
                        <input type="text" class="form-control" id="doctor_name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" id="doctor_email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" id="doctor_password" name="password" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Job Type:</label>
                        <input type="text" class="form-control" id="doctor_job_type" name="job_type" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Credential:</label>
                        <textarea class="form-control" id="doctor_credential" name="credential" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender:</label>
                        <select class="form-control" id="doctor_gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Consultation Fee:</label>
                        <input type="number" class="form-control" id="doctor_consultation_fee" name="consultation_fee"
                            step="0.01" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profile:</label>
                        <textarea class="form-control" id="doctor_profile" name="profile" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profile Image:</label>
                        <input type="file" class="form-control" id="doctor_profile_image" name="profile_image"
                            accept="image/*" required>
                        <small class="text-muted">Upload a profile picture (JPEG, PNG, etc.).</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Experience:</label>
                        <input type="text" class="form-control" id="doctor_experience" name="experience" required>
                    </div>
                </div>
                <button type="submit" name="submit_doctor" class="btn btn-success mt-3 w-100">Save Doctor</button>
            </form>
        </div>

        <!-- Hospital List -->
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
                <?php while ($row = $hospitals->fetch_assoc()): ?>
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
                        <button class="btn btn-warning btn-sm"
                            onclick="editHospital(<?= htmlspecialchars(json_encode($row)) ?>)">✏️ Edit</button>
                        <a href="?delete_hospital=<?= $row['hospital_id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Doctor List -->
        <h3 class="mt-4">Doctor List</h3>
        <table class="table table-striped fade-in">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Job Type</th>
                    <th>Gender</th>
                    <th>Fee</th>
                    <th>Experience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $doctors->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['doctor_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['job_type']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td><?= htmlspecialchars($row['consultation_fee']) ?></td>
                    <td><?= htmlspecialchars($row['experience']) ?></td>
                    <td class="btn-action">
                        <button class="btn btn-warning btn-sm"
                            onclick="editDoctor(<?= htmlspecialchars(json_encode($row)) ?>)">✏️ Edit</button>
                        <a href="?delete_doctor=<?= $row['doctor_id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Emergency Requests Modal -->
        <div class="modal fade" id="emergencyModal" tabindex="-1" aria-labelledby="emergencyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emergencyModalLabel">Emergency Requests</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="emergencyTable">
                        <?php if ($totalEmergencyRequests > 0): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Symptoms</th>
                                    <th>Location</th>
                                    <th>Submitted At</th>
                                </tr>
                            </thead>
                            <tbody id="emergencyRequestsBody">
                                <?php while ($row = $emergencyRequests->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                    <td><?= htmlspecialchars($row['symptoms']) ?></td>
                                    <td>
                                        <?= htmlspecialchars($row['division'] . ', ' . $row['township'] . ', ' . $row['street']) ?><br>
                                        Lat: <?= htmlspecialchars($row['latitude']) ?>, Lon:
                                        <?= htmlspecialchars($row['longitude']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['submitted_at']) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <p>No emergency requests found.</p>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Element for Beep Sound -->
    <audio id="emergencyBeep" src="https://www.soundjay.com/buttons/beep-01a.mp3" preload="auto"></audio>

    <script>
    function editHospital(hospital) {
        document.getElementById("hospital_id").value = hospital.hospital_id;
        document.getElementById("hospital_name").value = hospital.name;
        document.getElementById("hospital_location").value = hospital.location;
        document.getElementById("hospital_specialty").value = hospital.specialty;
        document.getElementById("hospital_contact").value = hospital.contact;
        document.getElementById("hospital_rating").value = hospital.rating;
        document.getElementById("hospital_emergency_services").value = hospital.emergency_services;
    }

    function editDoctor(doctor) {
        document.getElementById("doctor_id").value = doctor.doctor_id;
        document.getElementById("doctor_name").value = doctor.name;
        document.getElementById("doctor_email").value = doctor.email;
        document.getElementById("doctor_password").value = '';
        document.getElementById("doctor_job_type").value = doctor.job_type;
        document.getElementById("doctor_credential").value = doctor.credential;
        document.getElementById("doctor_gender").value = doctor.gender;
        document.getElementById("doctor_consultation_fee").value = doctor.consultation_fee;
        document.getElementById("doctor_profile").value = doctor.profile;
        document.getElementById("doctor_profile_image").value = doctor.profile_image;
        document.getElementById("doctor_experience").value = doctor.experience;
    }

    // AJAX to check for new emergency requests
    let lastCount = <?= $totalEmergencyRequests ?>;
    const beepSound = document.getElementById("emergencyBeep");

    function checkEmergencyRequests() {
        fetch('check_emergency.php')
            .then(response => response.json())
            .then(data => {
                const currentCount = data.total;
                if (currentCount > lastCount) {
                    // Play beep sound
                    beepSound.play();
                    lastCount = currentCount;

                    // Update badge count
                    document.getElementById("emergencyCount").innerText = currentCount;

                    // Update modal content
                    let tableBody = '';
                    if (currentCount > 0) {
                        data.requests.forEach(request => {
                            tableBody += `
                                <tr>
                                    <td>${request.id}</td>
                                    <td>${request.patient_name}</td>
                                    <td>${request.symptoms}</td>
                                    <td>${request.division}, ${request.township}, ${request.street}<br>Lat: ${request.latitude}, Lon: ${request.longitude}</td>
                                    <td>${request.submitted_at}</td>
                                </tr>
                            `;
                        });
                        document.getElementById("emergencyRequestsBody").innerHTML = tableBody;
                    } else {
                        document.getElementById("emergencyTable").innerHTML = '<p>No emergency requests found.</p>';
                    }
                }
            })
            .catch(error => console.error('Error fetching emergency requests:', error));
    }

    // Check every 5 seconds
    setInterval(checkEmergencyRequests, 5000);

    // Initial check on page load
    checkEmergencyRequests();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>