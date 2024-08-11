<?php

//this file use to adding data to doctor table 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get doctor data from POST request
$name = $_POST['name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Insert doctor data into the database
$sql = "INSERT INTO doctors (name, latitude, longitude) VALUES ('$name', '$latitude', '$longitude')";
if ($conn->query($sql) === TRUE) {
    echo "New doctor record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
