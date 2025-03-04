<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$doctorData = [];
$doctorAvailableDays = [];
$doctorAvailableTimes = [];
$selected_hospital_id = [];
$selected_hospital_name = [];

if (isset($_POST['doctor_id']) && isset($_POST['email'])) {
    $doctor_id = intval($_POST['doctor_id']);
    $useremail = htmlspecialchars($_POST['email']);

    // Fetch doctor details
    $sql = "SELECT d.name, d.profile, d.experience, d.consultation_fee, d.profile_image
            FROM doctors d 
            JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
            WHERE d.doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $doctorData = $result->fetch_assoc();
    }
    $stmt->close();

    $profileImage = !empty($doctorData['profile_image']) ? '/DAS/PHP/uploads/' . $doctorData['profile_image'] : '/DAS/PHP/uploads/default.png';

    // Fetch available days & times
    $sql = "SELECT available_day, available_time, hospital_id FROM doctor_hospital WHERE doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $day = strtoupper($row['available_day']); // Convert day to uppercase (MON, TUE, etc.)
        $doctorAvailableDays[$day][] = $row['available_time']; // Store time slots under respective day
        $selected_hospital_id[] = $row['hospital_id'];
    }

    $stmt->close();

    $sql = "SELECT name FROM hospitals WHERE hospital_id IN (" . implode(',', $selected_hospital_id) . ") ORDER BY FIELD(hospital_id, " . implode(',', $selected_hospital_id) . ")";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $selected_hospital_name[] = $row['name'];
    }
    $stmt->close();
} else {
    // Redirect to homepage if doctor_id or email is not provided
    header("Location: /DAS/");
    exit;
}

$conn->close();

// Get today's date & weekday
date_default_timezone_set('Asia/Yangon'); // Adjust timezone as needed
$current_date = date('Y-m-d');
$current_day = strtoupper(date('D')); // Example: "MON"

// Find the nearest available date
$selected_date = $current_date;
$selected_times = [];

if (!array_key_exists($current_day, $doctorAvailableDays)) {
    // If today is not available, find the next available date
    for ($i = 1; $i <= 7; $i++) {
        $next_date = date('Y-m-d', strtotime("+$i days"));
        $next_day = strtoupper(date('D', strtotime("+$i days")));

        if (array_key_exists($next_day, $doctorAvailableDays)) {
            $selected_date = $next_date;
            $selected_times = $doctorAvailableDays[$next_day]; // Get time slots for that day
            break;
        }
    }
} else {
    $selected_times = $doctorAvailableDays[$current_day]; // Use today's time slots if available
}

// Format selected date as "FEB 12 WED"
$display_date = strtoupper(date('M d D', strtotime($selected_date)));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-3.2.7.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }

        .navbar {
            background-color: #1a73e8;
        }

        .navbar a {
            color: #fff;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
        }

        .card {
            background-color: #fff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        h2 {
            font-size: 28px;
            color: #1a73e8;
        }

        .doctor-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .doctor-info img {
            border-radius: 50%;
            border: 4px solid #1a73e8;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .doctor-info h4 {
            font-size: 24px;
            color: #333;
            margin-top: 15px;
        }

        .doctor-info p {
            font-size: 16px;
            color: #555;
        }

        .info-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fafbfc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .info-box .label {
            font-size: 18px;
            font-weight: bold;
            color: #1a73e8;
        }

        .info-box .content {
            font-size: 16px;
            color: #333;
            max-width: 65%;
        }

        .date-box,
        .hospital-box,
        .time-box {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .option-box {
            width: 130px;
            height: 130px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #e7f3ff;
            border: 2px solid #1a73e8;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            color: #1a73e8;
            transition: all 0.3s ease;
        }

        .option-box:hover {
            background-color: #1a73e8;
            color: #fff;
            transform: scale(1.05);
        }

        .option-box.selected {
            background-color: #1a73e8;
            color: #fff;
        }

        .option-box.disabled {
            background-color: #ccc;
            border-color: #999;
            color: #666;
            cursor: not-allowed;
        }

        .option-box span {
            display: block;
            text-align: center;
        }

        .option-box .month,
        .option-box .day,
        .option-box .hospital-name,
        .option-box .time {
            font-size: 16px;
        }

        .form-section {
            margin-top: 30px;
        }

        .form-section .form-label {
            font-size: 16px;
            font-weight: bold;
            color: #1a73e8;
            margin-bottom: 10px;
        }

        .form-section .form-control {
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .form-section .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0px 0px 8px rgba(26, 115, 232, 0.3);
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .progress-step {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #e7f3ff;
            border-radius: 8px;
            margin: 0 5px;
            font-weight: bold;
            color: #1a73e8;
        }

        .progress-step.active {
            background-color: #1a73e8;
            color: #fff;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* Add a subtle shadow */
        }

        .container-fluid {
            align-items: center;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #1a73e8;
            border-color: #1a73e8;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #155ea7;
        }

        .btn-back {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-hospital"></i> Hospital Appointment System
            </a>
            <a href="/DAS/doctor" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-step active">1. Select Hospital</div>
                <div class="progress-step">2. Select Date</div>
                <div class="progress-step">3. Select Time</div>
            </div>

            <!-- Doctor Information -->
            <div class="doctor-info">
                <img id="doctor-img" src="<?php echo htmlspecialchars($profileImage); ?>?t=<?php echo time(); ?>" alt="Doctor Image">
                <h4 id="doctor"><?php echo $doctorData['name'] ?? 'Doctor Name'; ?></h4>
                <p><?php echo $doctorData['profile'] ?? 'Doctor Profile'; ?></p>
            </div>

            <!-- Hospital Selection -->
            <div class="form-section">
                <label class="form-label">Available Hospitals</label>
                <div class="hospital-box" id="hospital">
                    <?php foreach ($selected_hospital_name as $index => $hospital_name): ?>
                        <div class="option-box" data-hospital-id="<?php echo $selected_hospital_id[$index]; ?>">
                            <span class="hospital-name"><?php echo $hospital_name ?? 'Hospital Name'; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Date Selection -->
            <div class="form-section">
                <label class="form-label">Select Available Date</label>
                <div class="date-box" id="date-box"></div>
            </div>

            <!-- Time Selection -->
            <div class="form-section">
                <label class="form-label">Available Time</label>
                <div class="time-box" id="time-box"></div>
            </div>

            <!-- Booking Form -->
            <form id="booking-form">
                <div class="form-section">
                    <label class="form-label">Patient Name</label>
                    <input type="text" class="form-control" name="patient_name" id="patient_name" required placeholder="Enter your name">
                </div>
                <div class="form-section">
                    <label class="form-label">Symptoms</label>
                    <textarea class="form-control" name="symptoms" id="symptoms" rows="3" required placeholder="Describe your symptoms"></textarea>
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor_id; ?>">
                <input type="hidden" name="useremail" id="useremail" value="<?php echo $useremail; ?>">
                <input type="hidden" name="hospital_id" id="hospital_id" value="">
                <input type="hidden" name="appointment_date" id="appointment_date" value="">
                <input type="hidden" name="appointment_time" id="appointment_time" value="">
                <div id="message-box"></div>

                <!-- Buttons -->
                <div class="row mt-4">
                    <div class="col-md-6 mt-2">
                        <button id="btnCancel" class="btn btn-outline-secondary w-100 p-3">
                            <i class="fas fa-times"></i> Cancel Appointment
                        </button>
                    </div>
                    <div class="col-md-6 mt-2">
                        <button type="submit" class="btn btn-success w-100 p-3">
                            <i class="fas fa-check"></i> Confirm Appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-3.2.7.min.js"></script>
    <script src="/DAS/JS/booking-doctor.js"></script>
</body>

</html>