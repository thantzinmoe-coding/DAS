<?php
session_start();

// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'project';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . htmlspecialchars($conn->connect_error)]));
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $job_type = isset($_POST['job_type']) ? trim($_POST['job_type']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $credential = isset($_POST['credential']) ? trim($_POST['credential']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $consultation_fee = isset($_POST['consultation_fee']) ? floatval($_POST['consultation_fee']) : 0;
    $profile = isset($_POST['profile']) ? trim($_POST['profile']) : '';
    $experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';

    // Validate required fields
    if (empty($name) || empty($job_type) || empty($email) || empty($password) || empty($credential) || 
        empty($gender) || empty($consultation_fee) || empty($profile) || empty($experience)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Handle file upload (profile image)
    $profile_image = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '/DAS/PHP/uploads/';
        $file_name = uniqid() . '-' . basename($_FILES['profile_image']['name']);
        $upload_path = $upload_dir . $file_name;

        // Ensure the upload directory exists
        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $upload_dir)) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . $upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_path)) {
            $profile_image = $upload_path;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload profile image.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Profile image is required.']);
        exit();
    }

    // Hash the password (recommended for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into doctors table
    $stmt = $conn->prepare("INSERT INTO doctors (name, job_type, email, password, credential, gender, consultation_fee, profile, experience, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . htmlspecialchars($conn->error)]);
        exit();
    }

    // Corrected type string: 'ssssssssds' (consultation_fee as double)
    $stmt->bind_param('ssssssssds', $name, $job_type, $email, $hashed_password, $credential, $gender, $consultation_fee, $profile, $experience, $profile_image);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Doctor added successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add doctor: ' . htmlspecialchars($stmt->error)]);
    }

    $stmt->close();
    $conn->close();
    exit();
}

// If not a POST request, return an error
echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
$conn->close();
?>