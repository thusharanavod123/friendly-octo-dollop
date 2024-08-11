<?php
include 'db_connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $sql = "SELECT id, name, latitude, longitude FROM doctors";
    $result = $conn->query($sql);

    $doctors = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
    }

    echo json_encode($doctors);
}

$conn->close();

