<?php
$conn = new mysqli("localhost", "root", "", "chat_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM messages ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>" . $row["username"] . ":</strong> " . $row["message"] . "</p>";
}
$conn->close();
?>