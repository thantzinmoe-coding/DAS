<?php
header("Content-Type: application/json");

$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

if (!isset($_POST['hospital_id']) || !isset($_POST['doctor_id'])) {
    echo json_encode(["error" => "Invalid request"]);
    exit();
}

$hospital_id = intval($_POST['hospital_id']);
$doctor_id = intval($_POST['doctor_id']);

// Get doctor's available days from `doctor_hospital`
$sql = "SELECT available_day FROM doctor_hospital WHERE hospital_id = ? AND doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $hospital_id, $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$available_days = [];
while ($row = $result->fetch_assoc()) {
    $available_days[] = strtoupper($row['available_day']); // Store days in uppercase
}

$stmt->close();
$conn->close();

$upcoming_dates = [];

foreach ($available_days as $day) {
    $upcoming_dates = array_merge($upcoming_dates, getNextSevenWeekdays($day));
}

echo json_encode($upcoming_dates);

// Function to get the next 7 upcoming specific weekdays (e.g., Monday)
function getNextSevenWeekdays($weekday) {
    $daysOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
    $dayIndex = array_search($weekday, $daysOfWeek);

    if ($dayIndex === false) return []; // Invalid day name

    $today = new DateTime();
    $todayIndex = (int) $today->format('w'); // 0 = Sunday, 6 = Saturday

    $upcoming_dates = [];

    // Find the first occurrence of the target weekday
    $daysToAdd = ($dayIndex >= $todayIndex) ? ($dayIndex - $todayIndex) : (7 - ($todayIndex - $dayIndex));
    
    for ($i = 0; $i < 7; $i++) {
        $date = (new DateTime())->modify("+{$daysToAdd} days")->format('Y-m-d');
        $upcoming_dates[] = $date;
        $daysToAdd += 7; // Move to the next week
    }

    return $upcoming_dates;
}
?>