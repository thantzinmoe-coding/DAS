<?php
// Start output buffering and suppress all output except intentional JSON
ob_start();
error_reporting(0); // Disable all error reporting for production; log instead

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-HTTP-Method-Override');

// Database configuration
$dbHost = 'localhost';
$dbUser = 'root'; // Replace with your actual username
$dbPass = ''; // Replace with your actual password
$dbName = 'project';

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    file_put_contents('debug.log', "DB Error: " . $e->getMessage() . "\n", FILE_APPEND);
    ob_end_clean();
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

// Ensure uploads directory exists
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Log request details
$method = $_SERVER['REQUEST_METHOD'];
$override = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? 'None';
file_put_contents('debug.log', "Method: $method, Override: $override, URL: " . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);

switch($method) {
    case 'GET':
        if(isset($_GET['id'])) {
            $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = $doctor ? [$doctor] : [];
        } else {
            $stmt = $conn->prepare("SELECT * FROM doctors");
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        }
        ob_end_clean();
        echo json_encode($response);
        break;

    case 'POST':
        $isUpdate = isset($_POST['doctor_id']);
        
        $requiredFields = ['name', 'email', 'job_type', 'credential', 'gender', 'consultation_fee', 'profile', 'experience'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                ob_end_clean();
                echo json_encode(['error' => "Field '$field' is required."]);
                exit;
            }
        }

        $profileImage = 'default.jpg';
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['profile_image'];
            $fileName = uniqid() . '-' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $profileImage = $fileName;
            } else {
                ob_end_clean();
                echo json_encode(['error' => 'Failed to upload image.']);
                exit;
            }
        } elseif (!$isUpdate) {
            ob_end_clean();
            echo json_encode(['error' => 'Profile image is required for new doctors.']);
            exit;
        }

        if ($isUpdate) {
            $stmt = $conn->prepare("UPDATE doctors SET 
                name = :name,
                email = :email,
                job_type = :job_type,
                credential = :credential,
                gender = :gender,
                consultation_fee = :consultation_fee,
                profile = :profile,
                profile_image = :profile_image,
                experience = :experience
                WHERE doctor_id = :id");
            
            $stmt->execute([
                ':id' => $_POST['doctor_id'],
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':job_type' => $_POST['job_type'],
                ':credential' => $_POST['credential'],
                ':gender' => $_POST['gender'],
                ':consultation_fee' => $_POST['consultation_fee'],
                ':profile' => $_POST['profile'],
                ':profile_image' => $profileImage,
                ':experience' => $_POST['experience']
            ]);
            $response = ['success' => true];
        } else {
            if (empty($_POST['password'])) {
                ob_end_clean();
                echo json_encode(['error' => 'Password is required for new doctors.']);
                exit;
            }

            $stmt = $conn->prepare("INSERT INTO doctors (name, email, password, job_type, credential, gender, consultation_fee, profile, profile_image, experience) 
                VALUES (:name, :email, :password, :job_type, :credential, :gender, :consultation_fee, :profile, :profile_image, :experience)");
            
            $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ':job_type' => $_POST['job_type'],
                ':credential' => $_POST['credential'],
                ':gender' => $_POST['gender'],
                ':consultation_fee' => $_POST['consultation_fee'],
                ':profile' => $_POST['profile'],
                ':profile_image' => $profileImage,
                ':experience' => $_POST['experience']
            ]);
            $response = ['success' => true, 'id' => $conn->lastInsertId()];
        }
        ob_end_clean();
        echo json_encode($response);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT profile_image FROM doctors WHERE doctor_id = :id");
        $stmt->execute([':id' => $id]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($doctor && $doctor['profile_image'] != 'default.jpg') {
            unlink($uploadDir . $doctor['profile_image']);
        }

        $stmt = $conn->prepare("DELETE FROM doctors WHERE doctor_id = :id");
        $stmt->execute([':id' => $id]);
        ob_end_clean();
        echo json_encode(['success' => true]);
        break;

    default:
        ob_end_clean();
        echo json_encode(['error' => 'Method not allowed']);
        break;
}

exit; // Ensure no further output
?>