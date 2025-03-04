<?php
session_start();

// Set the fixed security key
define('ADMIN_SECURITY_KEY', 'Admin@1234');

// If the user has not entered the correct key, show the key entry form
if (!isset($_SESSION['admin_access']) || $_SESSION['admin_access'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $entered_key = $_POST['security_key'];

        // Check if the entered key matches the predefined security key
        if ($entered_key === ADMIN_SECURITY_KEY) {
            $_SESSION['admin_access'] = true;  // Grant access
            header('Location: admin_hospitals.php');  // Reload the page to show admin panel
            exit();
        } else {
            $error_message = '❌ Incorrect Security Key. Access Denied!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Secure Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 400px;
        margin-top: 100px;
    }

    .card {
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <h2 class="text-center">🔐 Admin Secure Login</h2>

            <?php if (isset($error_message)): ?>
            <p class="text-danger text-center"><?= $error_message ?></p>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Enter Security Key:</label>
                    <input type="password" name="security_key" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Access Admin Panel</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php
    exit();  // Stop execution so the rest of the code is not displayed
}
?>

<!-- ORIGINAL CODE STARTS HERE (NO CHANGES MADE) -->

<?php
// Database Connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'project';

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Handle Add & Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $conn->real_escape_string($_POST['name']);
    $location = $conn->real_escape_string($_POST['location']);
    $specialty = $conn->real_escape_string($_POST['specialty']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $emergency_services = isset($_POST['emergency_services']) ? 1 : 0;  // New addition

    if ($id) {
        $sql = "UPDATE hospitals SET name='$name', location='$location', specialty='$specialty', contact='$contact', emergency_services='$emergency_services' WHERE id=$id";
        $message = ($conn->query($sql) === TRUE) ? 'Hospital updated successfully!' : 'Error: ' . $conn->error;
    } else {
        $sql = "INSERT INTO hospitals (name, location, specialty, contact, emergency_services) VALUES ('$name', '$location', '$specialty', '$contact', '$emergency_services')";
        $message = ($conn->query($sql) === TRUE) ? 'Hospital added successfully!' : 'Error: ' . $conn->error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM hospitals WHERE id=$id";
    $message = ($conn->query($sql) === TRUE) ? 'Hospital deleted successfully!' : 'Error: ' . $conn->error;
}

// Fetch Hospitals
$result = $conn->query('SELECT * FROM hospitals');
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hospitals</title>
    <style>
    /* YOUR ORIGINAL CSS CODE IS UNCHANGED */
    </style>
    <script>
    function editHospital(id, name, location, specialty, contact, emergency_services) {
        document.getElementById("id").value = id;
        document.getElementById("name").value = name;
        document.getElementById("location").value = location;
        document.getElementById("specialty").value = specialty;
        document.getElementById("contact").value = contact;
        document.getElementById("emergency_services").checked = emergency_services == 1 ? true : false; // New addition

        document.getElementById("form-title").innerText = "Edit Hospital";
        document.getElementById("submit-btn").innerText = "Update Hospital";
        document.querySelector('.container').classList.add("form-container");
    }
    </script>
</head>

<body>

    <h2 id="form-title">Add a New Hospital</h2>

    <?php if (isset($message)) echo "<p style='color: green; text-align: center;'>$message</p>"; ?>

    <div class="container">
        <form method="POST" action="">
            <input type="hidden" id="id" name="id">
            <label for="name">Hospital Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty">

            <label for="contact">Contact Number:</label>
            <input type="tel" id="contact" name="contact" required>
            <label for="emergency_services">Emergency Services:</label>
            <div>
                <input type="checkbox" id="emergency_services" name="emergency_services" value="1">
                <label for="emergency_services">Available</label>
            </div>

            <button type="submit" class="add-btn" id="submit-btn">Add Hospital</button>
        </form>
    </div>
    <h2>Hospital List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Specialty</th>
                <th>Contact</th>
                <th>Emergency Services</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="fade-in">
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['specialty'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td><?= $row['emergency_services'] ? '✅ Yes' : '❌ No' ?></td>
                <td>
                    <button class="edit-btn"
                        onclick="editHospital('<?= $row['id'] ?>', '<?= addslashes($row['name']) ?>', '<?= addslashes($row['location']) ?>', '<?= addslashes($row['specialty']) ?>', '<?= addslashes($row['contact']) ?>', '<?= $row['emergency_services'] ?>')">Edit</button>

                    <a href="?delete=<?= $row['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this hospital?');">
                        <button class="delete-btn">Delete</button>
                    </a>
                </td>
            </tr>

            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>