<?php
// This file is for table creation only (one-time execution). There is another file to get DB connection.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL to create doctors table
$sql = "CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'doctors' created successfully<br>";
} else {
    echo "Error creating table 'doctors': " . mysqli_error($conn) . "<br>";
}

// SQL to create cowCage table
$sql1 = "CREATE TABLE cowCage (
    Cageid INT AUTO_INCREMENT PRIMARY KEY,
    CowNumber INT 
)";

if (mysqli_query($conn, $sql1)) {
    echo "Table 'cowCage' created successfully<br>";
} else {
    echo "Error creating table 'cowCage': " . mysqli_error($conn) . "<br>";
}

// Close connection
mysqli_close($conn);
