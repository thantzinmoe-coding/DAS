<?php
// Get the JSON data from the request body
header('Content-Type: application/json');
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

if ($data) {
    // Process data based on the source
    if ($data['source'] === 'file1') {
        $name = $data['name'];
        echo "Data received from File 1: Name = $name";
    } elseif ($data['source'] === 'file2') {
        $email = $data['email'];
        echo "Data received from File 2: Email = $email";
    } else {
        echo "Invalid source!";
    }
} else {
    echo "No data received!";
}
?>
