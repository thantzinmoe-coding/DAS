<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    echo "Hello, " . htmlspecialchars($username) . "! This was submitted via jQuery.";
}
?>