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
        $sql = "UPDATE hospitals SET name='$name', location='$location', specialty='$specialty', contact='$contact', emergency_services='$emergency_services' WHERE hospital_id=$id";
        $message = ($conn->query($sql) === TRUE) ? '<span style="color: green; font-size: 20px;">✅</span>' : 'Error: ' . $conn->error;
    } else {
        $sql = "INSERT INTO hospitals (name, location, specialty, contact, emergency_services) VALUES ('$name', '$location', '$specialty', '$contact', '$emergency_services')";
        $message = ($conn->query($sql) === TRUE) ? '<span style="color: green; font-size: 20px;">✅</span>' : 'Error: ' . $conn->error;
    }

    // Handle Delete
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM hospitals WHERE hospital_id=$id";
        $message = ($conn->query($sql) === TRUE) ? '<span style="color: green; font-size: 20px;">✅</span>' : 'Error: ' . $conn->error;
    }
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
    body {
        font-family: 'Arial', sans-serif;
        margin: 40px;
        background: #f4f6f8;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-container {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
        color: #555;
    }

    input[type="text"],
    input[type="tel"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s ease-in-out;
    }

    input:focus {
        border-color: #007bff;
        outline: none;
        transform: scale(1.02);
    }

    button {
        width: 100%;
        padding: 10px;
        margin-top: 15px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
        transform: translateY(-3px);
    }

    .add-btn {
        background: #007bff;
        color: white;
    }

    .add-btn:hover {
        background: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        padding: 10px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #007bff;
        color: white;
    }

    .edit-btn {
        background: #ffa500;
        color: white;
    }

    .edit-btn:hover {
        background: #e69500;
    }

    .delete-btn {
        background: #dc3545;
        color: white;
    }

    .delete-btn:hover {
        background: #bb2d3b;
    }

    .fade-in {
        animation: fadeInRow 0.5s ease-in-out;
    }

    @keyframes fadeInRow {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
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

    <!-- Hospital Form -->
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

    <!-- Hospitals Table -->
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
                <td><?= $row['hospital_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['specialty'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td><?= $row['emergency_services'] ? '✅ Yes' : '❌ No' ?></td>
                <td>
                    <button class=" edit-btn" onclick="editHospital(
                        '<?= htmlspecialchars($row['hospital_id'], ENT_QUOTES, 'UTF-8') ?>', 
                        '<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?>', 
                        '<?= htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8') ?>', 
                        '<?= htmlspecialchars($row['specialty'], ENT_QUOTES, 'UTF-8') ?>', 
                        '<?= htmlspecialchars($row['contact'], ENT_QUOTES, 'UTF-8') ?>',
                        '<?= htmlspecialchars($row['emergency_services'], ENT_QUOTES, 'UTF-8') ?>'
                    )">Edit</button>
                    <a href="?delete=<?= $row['hospital_id'] ?>"
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