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

$hospital_id = 0;

// Unset hospital_id on page reload
if (isset($_SESSION['hospital_id'])) {
    $hospital_id = $_SESSION['hospital_id'];
}

// Fetch total doctors count
$totalDoctorsQuery = 'SELECT COUNT(DISTINCT doctor_id) AS total_doctors FROM doctor_hospital WHERE hospital_id = ?';
$stmt = $conn->prepare($totalDoctorsQuery);
$stmt->bind_param('i', $hospital_id);
$stmt->execute();
$totalDoctorsResult = $stmt->get_result()->fetch_assoc();
$totalDoctors = $totalDoctorsResult['total_doctors'];

// Fetch doctors for this hospital
$doctorQuery = '
   SELECT dh.id, d.doctor_id, d.name, d.job_type, dh.available_day, dh.available_time,
       (SELECT COUNT(*) FROM booking WHERE booking.doctor_id = d.doctor_id AND booking.hospital_id = dh.hospital_id) AS total_appointments
FROM doctor_hospital dh
JOIN doctors d ON dh.doctor_id = d.doctor_id
WHERE dh.hospital_id = ?';
$stmt = $conn->prepare($doctorQuery);
$stmt->bind_param('i', $hospital_id);
$stmt->execute();
$doctorResult = $stmt->get_result();

// Fetch Emergency Requests Count for this hospital
$emergencyRequestsQuery = 'SELECT COUNT(*) AS total_emergencies FROM emergency_requests WHERE hospital_id = ?';
$stmt = $conn->prepare($emergencyRequestsQuery);
$stmt->bind_param('i', $hospital_id);
$stmt->execute();
$totalEmergenciesResult = $stmt->get_result()->fetch_assoc();
$totalEmergencies = $totalEmergenciesResult['total_emergencies'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .dashboard-card {
        border-radius: 10px;
        background: white;
        padding: 20px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .dashboard-card:hover {
        transform: scale(1.03);
    }

    .table-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Notification Badge Style */
    .notification-badge {
        cursor: pointer;
        position: relative;
    }

    .notification-badge:hover {
        text-decoration: underline;
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">🏥 Hospital Admin Dashboard</h2>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="dashboard-card text-center">
                    <h4>Total Doctors</h4>
                    <h2 class="text-primary"><?= $totalDoctors ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card text-center">
                    <h4>Total Appointments</h4>
                    <h2 class="text-success">
                        <?php
                        $appointmentCountQuery = 'SELECT COUNT(*) AS total_appointments FROM booking b JOIN doctor_hospital dh ON b.doctor_id = dh.doctor_id WHERE dh.hospital_id = ?';
                        $stmt = $conn->prepare($appointmentCountQuery);
                        $stmt->bind_param('i', $hospital_id);
                        $stmt->execute();
                        $appointmentCountResult = $stmt->get_result()->fetch_assoc();
                        echo $appointmentCountResult['total_appointments'];
                        ?>
                    </h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card text-center notification-badge" data-bs-toggle="modal"
                    data-bs-target="#emergencyModal">
                    <h4>Emergency Requests</h4>
                    <h2 class="text-danger" id="emergencyCount"><?= $totalEmergencies ?></h2>
                </div>
            </div>
        </div>

        <!-- Doctor List -->
        <h2 class="text-center mb-4">🩺 Doctor List</h2>
        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="table-primary small">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Available Days</th>
                        <th>Available Time</th>
                        <th>Total Appointments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php while ($doctor = $doctorResult->fetch_assoc()): ?>
                    <tr>
                        <td><?= $doctor['doctor_id'] ?></td>
                        <td><?= htmlspecialchars($doctor['name']) ?></td>
                        <td><?= htmlspecialchars($doctor['job_type']) ?></td>
                        <td><?= htmlspecialchars($doctor['available_day']) ?></td>
                        <td><?= htmlspecialchars($doctor['available_time']) ?></td>
                        <td><?= $doctor['total_appointments'] ?></td>
                        <td>
                            <a href="<?php echo '/DAS/PHP/hos_admin_view_appointment.php?doctor_id=' . htmlspecialchars($doctor['doctor_id']); ?>"
                                class="btn btn-info btn-sm">View Appointments</a>
                            <?php if ($doctor['total_appointments'] == 0): ?>
                            <a href="<?php echo '/DAS/PHP/edit_doctor.php?doctor_id=' . htmlspecialchars($doctor['doctor_id']); ?>"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?php echo '/DAS/PHP/delete_doctor_availability.php?id=' . htmlspecialchars($doctor['id']); ?>"
                                class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                            <?php else: ?>
                            <button class="btn btn-warning btn-sm" disabled
                                onclick="alert('Cannot edit doctor with existing appointments'); return false;">Edit</button>
                            <button class="btn btn-danger btn-sm" disabled
                                onclick="alert('Cannot delete doctor with existing appointments'); return false;">Delete</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <form action="/DAS/PHP/logout.php">
                <a href="/DAS/add-doctor-availability" class="btn btn-success mb-3">➕ Add Doctor Availability</a>
                <button class="btn btn-danger mb-3 float-end">Log Out</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="emergencyModal" tabindex="-1" aria-labelledby="emergencyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emergencyModalLabel">Emergency Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="emergencyTable">
                    <?php if ($totalEmergencies > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient Name</th>
                                <th>Symptoms</th>
                                <th>Location</th>
                                <th>Submitted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="emergencyRequestsBody">
                            <?php
                            $stmt = $conn->prepare('SELECT * FROM emergency_requests WHERE hospital_id = ? ORDER BY submitted_at DESC');
                            $stmt->bind_param('i', $hospital_id);
                            $stmt->execute();
                            $emergencyRequests = $stmt->get_result();
                            while ($row = $emergencyRequests->fetch_assoc()): ?>
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
                                <td>
                                    <button class="btn btn-success btn-sm mark-done" data-id="<?= $row['id'] ?>">Mark as
                                        Done</button>
                                </td>
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
    <script>
    let hospitalId = <?php echo isset($_SESSION['hospital_id']) ? json_encode($_SESSION['hospital_id']) : 'null'; ?>;
    console.log("Current Hospital ID:", hospitalId);

    let lastCount = <?= $totalEmergencies ?>;
    const beepSound = document.getElementById("emergencyBeep");

    function checkEmergencyRequests() {
        fetch('/DAS/PHP/check_hospital_emergency.php?hospital_id=' + hospitalId)
            .then(response => response.json())
            .then(data => {
                const currentCount = data.total;
                console.log("Current emergency count:", currentCount, "Last count:", lastCount);
                if (currentCount !== lastCount) { // Changed to !== to update on any change
                    lastCount = currentCount;
                    document.getElementById("emergencyCount").innerText = currentCount;

                    let tableBody = '';
                    if (currentCount > 0) {
                        // Sort requests by submitted_at descending (newest first)
                        data.requests.sort((a, b) => new Date(b.submitted_at) - new Date(a.submitted_at));

                        data.requests.forEach(request => {
                            tableBody += `
                            <tr>
                                <td>${request.id}</td>
                                <td>${request.patient_name}</td>
                                <td>${request.symptoms}</td>
                                <td>${request.division}, ${request.township}, ${request.street}<br>Lat: ${request.latitude}, Lon: ${request.longitude}</td>
                                <td>${request.submitted_at}</td>
                                <td>
                                    <button class="btn btn-success btn-sm mark-done" data-id="${request.id}">Mark as Done</button>
                                </td>
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

    // Handle Mark as Done button clicks
    document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('mark-done')) {
            const requestId = e.target.getAttribute('data-id');

            if (!requestId) {
                console.error("Error: No request ID found.");
                alert("Invalid request. Please try again.");
                return;
            }

            try {
                const response = await fetch('/DAS/PHP/mark_emergency_done.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `request_id=${encodeURIComponent(requestId)}`
                });

                const rawData = await response.text(); // Get raw response
                console.log("Raw response:", rawData); // Debugging

                let data;
                try {
                    data = JSON.parse(rawData); // Try parsing JSON
                } catch (jsonError) {
                    console.error("JSON Parsing Error:", jsonError, "Response:", rawData);
                    alert("Unexpected server response. Please check console logs.");
                    return;
                }

                if (data.success) {
                    // Remove the row from the table
                    e.target.closest('tr').remove();
                    lastCount--;
                    document.getElementById("emergencyCount").innerText = lastCount;

                    if (lastCount === 0) {
                        document.getElementById("emergencyTable").innerHTML =
                            '<p>No emergency requests found.</p>';
                    }
                } else {
                    alert(data.error || 'Failed to mark request as done.');
                }

            } catch (error) {
                console.error('Error marking as done:', error);
                alert("An error occurred. Please check your internet connection.");
            }
        }
    });

    setInterval(checkEmergencyRequests, 5000);
    checkEmergencyRequests();

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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>