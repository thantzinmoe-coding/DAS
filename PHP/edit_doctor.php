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

// Fetch existing doctor details
$query = 'SELECT d.doctor_id, d.name, d.job_type, GROUP_CONCAT(dh.available_day) AS available_day, GROUP_CONCAT(dh.available_time) AS available_time
          FROM doctors d
          JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
          WHERE d.doctor_id = ?
          GROUP BY d.doctor_id';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Doctor not found.');
}

$doctor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $job_type = trim($_POST['job_type']);
    $available_days = isset($_POST['available_days']) ? $_POST['available_days'] : [];
    $available_times = isset($_POST['available_times']) ? $_POST['available_times'] : [];

    if (!empty($name) && !empty($job_type)) {
        // Update doctor details
        $updateQuery = 'UPDATE doctors SET name = ?, job_type = ? WHERE doctor_id = ?';
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ssi', $name, $job_type, $doctor_id);
        $stmt->execute();

        // Get existing availability for the doctor
        $existingAvailabilityQuery = 'SELECT available_day, available_time FROM doctor_hospital WHERE doctor_id = ?';
        $stmt = $conn->prepare($existingAvailabilityQuery);
        $stmt->bind_param('i', $doctor_id);
        $stmt->execute();
        $existingResult = $stmt->get_result();
        $existingAvailability = [];
        while ($row = $existingResult->fetch_assoc()) {
            $existingAvailability[$row['available_day']] = $row['available_time'];
        }

        $hospital_id = $_SESSION['hospital_id'];  // Assuming hospital_id is stored in session

        // Only insert new availability for checked days; keep existing availability unchanged
        $insertAvailabilityQuery = 'INSERT INTO doctor_hospital (doctor_id, hospital_id, available_day, available_time) VALUES (?, ?, ?, ?)';
        foreach ($available_days as $index => $day) {
            $time = trim($available_times[$index]);
            if (!empty($time)) {
                // Check if this day already exists for the doctor
                if (!isset($existingAvailability[$day])) {
                    $stmt = $conn->prepare($insertAvailabilityQuery);
                    $stmt->bind_param('iiss', $doctor_id, $hospital_id, $day, $time);
                    $stmt->execute();
                } else {
                    // Update existing time for this day if different
                    if ($existingAvailability[$day] !== $time) {
                        $updateTimeQuery = 'UPDATE doctor_hospital SET available_time = ? WHERE doctor_id = ? AND available_day = ?';
                        $stmt = $conn->prepare($updateTimeQuery);
                        $stmt->bind_param('sis', $time, $doctor_id, $day);
                        $stmt->execute();
                    }
                }
            }
        }

        echo "<script>alert('Doctor updated successfully!'); window.location.href='/DAS/adminDashboard-hospital';</script>";
        exit();
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        max-width: 750px;
        margin: 40px auto;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    h2 {
        font-weight: 600;
        text-align: center;
        color: #333;
    }

    .form-label {
        font-weight: 500;
        color: #555;
    }

    .form-control,
    .form-check-input {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0px 0px 6px rgba(76, 175, 80, 0.4);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        width: 100%;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .form-check-label {
        font-weight: 500;
        color: #444;
    }

    .available-day-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f1f3f5;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 8px;
        transition: 0.3s;
    }

    .available-day-container:hover {
        background: #e9ecef;
    }

    .time-input {
        width: 60%;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 8px;
        margin-left: 10px;
        background-color: #fff;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Edit Doctor</h2>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Doctor Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?= htmlspecialchars($doctor['name']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Specialty</label>
                    <input type="text" name="job_type" class="form-control"
                        value="<?= htmlspecialchars($doctor['job_type']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Available Days & Time</label>
                    <div id="available_days_container">
                        <?php
                        $days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                        $selectedDays = explode(",", $doctor['available_day'] ?? '');
                        $selectedTimes = explode(",", $doctor['available_time'] ?? '');
                        $timeIndex = 0;
                        foreach ($days as $day) {
                            $isChecked = in_array($day, $selectedDays) ? 'checked' : '';
                            $time = $isChecked ? ($selectedTimes[$timeIndex++] ?? '') : '';
                            echo "
                                <div class='available-day-container'>
                                    <input class='form-check-input' type='checkbox' name='available_days[]' value='$day' onclick='toggleTextInput(this)' $isChecked>
                                    <label class='form-check-label'>$day</label>
                                    <input type='text' name='available_times[]' class='form-control time-input' placeholder='12pm-2pm' value='$time' " . ($isChecked ? '' : 'disabled') . ">
                                </div>
                            ";
                        }
                        ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Update Doctor</button>
                <a href="/DAS/adminDashboard-hospital" class="btn btn-secondary mt-2">Cancel</a>
            </form>
        </div>
    </div>

    <script>
    function toggleTextInput(checkbox) {
        let textInput = checkbox.closest('.available-day-container').querySelector('.time-input');
        textInput.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            textInput.value = ''; // Clear the time if unchecked
        }
    }

    document.getElementById("add_doctor_form").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('/DAS/PHP/edit_doctor.php?doctor_id=' + <?= $doctor_id ?>, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Notiflix.Report.success('Success', data.message, 'Okay', () => {
                        window.location.href = '/DAS/adminDashboard-hospital';
                    })
                }
            })
            .catch(error => console.error('Error:', error));
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix"></script>
</body>

</html>

<?php $conn->close(); ?>