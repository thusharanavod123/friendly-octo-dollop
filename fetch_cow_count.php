<?php
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

$cage = isset($_GET['cage']) ? intval($_GET['cage']) : 0;

if ($cage > 0) {
    // selecting cowNumber according to the provided cageId
    $query = "SELECT CowNumber FROM cowcage WHERE Cageid = $cage";

    // Fetching data from the database
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Assuming one row per cage with cow number count
        $row = $result->fetch_assoc();
        $actualCowCount = $row['CowNumber'];
    } else {
        $actualCowCount = 0;
    }
    
    // Returning JSON response
    echo json_encode(['actualCowCount' => $actualCowCount]);
} else {
    echo json_encode(['actualCowCount' => 0]);
}

// Close the connection
$conn->close();
