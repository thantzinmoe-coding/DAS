<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

session_start();
if(isset($_SESSION['email'])){
    $useremail = $_SESSION['email'];
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Basic String Matching Algorithm (Case-Insensitive)
$sql = "SELECT * FROM doctors 
        WHERE LOWER(name) LIKE LOWER('%$search%') 
        OR LOWER(job_type) LIKE LOWER('%$search%') 
        OR LOWER(credential) LIKE LOWER('%$search%')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='job-card'>";
        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['credential']) . "</p>";
        echo "<div class='details'>";
        echo "<span>ဆွေးနွေးခ: " . number_format($row['consultation_fee']) . " MMK</span>";
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            // If user is logged in, allow booking
            echo '<form method="POST" action="/DAS/booking-doctor">';
            echo '<input type="hidden" name="doctor_id" value="' . filter_var($row['doctor_id'], FILTER_VALIDATE_INT) . '">';
            echo '<input type="hidden" name="email" value="' . $useremail . '">';
            echo '<button type="submit">Book Now</button>';
            echo '</form>';
        } else {
            // If user is not logged in, show alert and redirect using JavaScript
            echo '<button onclick="redirectToLogin()">Book Now</button>';
        }
        echo '</form>';
        echo "</div>";
        echo "</div>";
    }
    if (isset($_POST['doctor_id'])) {
        exit;
    }
} else {
    echo "<p>သင်၏ရှာဖွေမှုနှင့်ကိုက်ညီသော ဆရာဝန်များ ရှာမတွေ့ပါ။</p>";
}

$conn->close();
