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

// Fetch all doctors from the database
$doctors = [];
$query = "SELECT doctor_id, name, job_type FROM doctors";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = intval($_POST['doctor_id']);
    $available_days = isset($_POST['available_days']) ? $_POST['available_days'] : [];
    $available_times = isset($_POST['available_times']) ? $_POST['available_times'] : [];

    if (!empty($doctor_id) && !empty($available_days) && !empty($available_times)) {
        if (!isset($_SESSION['hospital_id'])) {
            die('Hospital ID is not set.');
        }
        $hospital_id = $_SESSION['hospital_id'];
        // Insert available days and times into doctor_hospital
        $stmt = $conn->prepare("INSERT INTO doctor_hospital (doctor_id, hospital_id, available_day, available_time) VALUES (?, ?, ?, ?)");

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        foreach ($available_days as $index => $day) {
            if (!empty($day) && !empty($available_times[$index])) {
                // Debugging: Print data being inserted
                echo "Inserting: Doctor ID = $doctor_id, Hospital ID = $hospital_id, Day = $day, Time = {$available_times[$index]}<br>";

                $stmt->bind_param('iiss', $doctor_id, $hospital_id, $day, $available_times[$index]);
                if (!$stmt->execute()) {
                    die('Execute failed: ' . htmlspecialchars($stmt->error));
                }
            }
        }
        $stmt->close();

        echo "<script>alert('Doctor availability added successfully!'); window.location.href='/DAS/adminDashboard-hospital';</script>";
        exit();
    } else {
        echo "<script>alert('Please select a doctor and provide availability details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 750px;
        margin-top: 50px;
    }

    .card {
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    h2 {
        font-weight: bold;
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #555;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px;
    }

    .btn {
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .available-day-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f1f3f5;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: 0.3s;
    }

    .available-day-container:hover {
        background: #e9ecef;
    }

    .time-input {
        width: 50%;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 8px;
        background-color: #fff;
    }

    .search-box {
        position: relative;
    }

    .search-icon {
        position: absolute;
        top: 10px;
        right: 12px;
        color: gray;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Add Doctor Availability</h2>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Search Doctor</label>
                    <div class="search-box">
                        <input type="text" id="doctorSearch" class="form-control" placeholder="Search by name...">
                        <i class="search-icon bi bi-search"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Doctor</label>
                    <select name="doctor_id" id="doctorDropdown" class="form-select" required>
                        <option value="">-- Select a Doctor --</option>
                        <?php foreach ($doctors as $doctor) : ?>
                        <option value="<?= $doctor['doctor_id'] ?>"><?= $doctor['name'] ?> - <?= $doctor['job_type'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Available Days & Time</label>
                    <div id="available_days_container">
                        <?php
                        $days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                        foreach ($days as $day) {
                            echo "
                                <div class='available-day-container'>
                                    <input class='form-check-input me-2' type='checkbox' name='available_days[]' value='$day' onclick='toggleTextInput(this)'>
                                    <label class='me-2'>$day</label>
                                    <input type='text' name='available_times[]' class='form-control time-input' placeholder='12PM-2PM' disabled>
                                </div>
                            ";
                        }
                        ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Add Availability</button>
                <a href="/DAS/adminDashboard-hospital" class="btn btn-secondary w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>

    <script>
    // Search doctors dynamically
    $(document).ready(function() {
        $("#doctorSearch").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#doctorDropdown option").each(function() {
                let text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(value));
            });
        });
    });

    // Enable time input only when day is checked
    function toggleTextInput(checkbox) {
        let textInput = checkbox.closest('.available-day-container').querySelector('.time-input');
        textInput.disabled = !checkbox.checked;
    }
    </script>
</body>


</html>

<?php $conn->close(); ?>