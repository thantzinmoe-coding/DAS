<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = intval($_POST['doctor_id']);
    $hospital_id = intval($_POST['hospital_id']);
    $useremail = htmlspecialchars($_POST['useremail']);
    $date = $_POST['date'];
    $time = $_POST['time']; // e.g., "12PM-2PM"
    $patient_name = htmlspecialchars($_POST['patient_name']);
    $symptoms = htmlspecialchars($_POST['symptoms']);
    $token_number = intval($_POST['token_number']);

    // Split time into start and end
    list($start_time, $end_time) = explode("-", $time);

    // Check for overlapping bookings
    $sql = "SELECT COUNT(*) FROM booking 
            WHERE doctor_id = ? AND hospital_id = ? AND appointment_date = ? 
            AND ((appointment_start_time < ?) AND (appointment_end_time > ?))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $doctor_id, $hospital_id, $date, $end_time, $start_time);
    $stmt->execute();
    $result = $stmt->get_result();
    $overlap = $result->fetch_row()[0];

    if ($overlap > 0) {
        echo json_encode(["error" => "This time slot is already booked."]);
        $stmt->close();
        $conn->close();
        exit;
    }

    // Insert booking
    $sql = "INSERT INTO booking (doctor_id, hospital_id, useremail, appointment_date, 
            appointment_start_time, appointment_end_time, patient_name, symptoms, token_number) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssssi", $doctor_id, $hospital_id, $useremail, $date, 
                      $start_time, $end_time, $patient_name, $symptoms, $token_number);

    if ($stmt->execute()) {
        $appointment_id = $stmt->insert_id;

        // Fetch doctor and hospital names and location for the Patient object
        $sql = "SELECT d.name AS doctor_name, h.name AS hospital_name, h.location 
                FROM doctors d 
                JOIN hospitals h ON h.hospital_id = ? 
                WHERE d.doctor_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $hospital_id, $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $details = $result->fetch_assoc();
        $doctor_name = $details['doctor_name'] ?? 'Unknown Doctor';
        $hospital_name = $details['hospital_name'] ?? 'Unknown Hospital';
        $location = $details['location'] ?? 'Unknown Location';

        // Include patient.php to use the Patient class and sendAppointmentEmail function
        require_once 'patient.php';

        // Create Patient object
        $patient = new Patient(
            $patient_name,              // name
            $useremail,                 // email
            $doctor_name,               // doctor
            $hospital_name,             // hospital
            $location,                  // location
            $symptoms,                  // symptoms
            date('d M Y', strtotime($date)), // appointmentDate (formatted as "03 Mar 2025")
            "$start_time-$end_time",    // appointment_time (e.g., "12pm-2pm")
            $token_number          // token_number
        );

        // Send email using the function from patient.php
        sendAppointmentEmail($patient);

        // Prepare response
        $email_sent = true; // Assume email sending succeeded (you can check the return value if sendAppointmentEmail returns a status)
        if ($email_sent) {
            echo json_encode(["message" => "Booking successful! Appointment ID: $appointment_id - Confirmation email sent."]);
        } else {
            echo json_encode(["message" => "Booking successful! Appointment ID: $appointment_id - Email failed to send."]);
        }
    } else {
        echo json_encode(["error" => "Failed to book appointment: " . $stmt->error]);
    }
    $stmt->close();
}
$conn->close();
?>