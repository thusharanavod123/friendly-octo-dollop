<?php

include 'db.php';

// Create the users table with geolocation
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('farmer', 'vet', 'admin') NOT NULL,
    contact_number VARCHAR(15), -- Added contact number field
    latitude DECIMAL(10, 8), -- Latitude field for geolocation
    longitude DECIMAL(11, 8), -- Longitude field for geolocation
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully\n";
} else {
    echo "Error creating table 'users': " . $conn->error . "\n";
}


// Create the animals table
$sql = "CREATE TABLE IF NOT EXISTS animals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    species VARCHAR(100) NOT NULL,
    breed VARCHAR(100),
    birth_date DATE,
    health_status VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'animals' created successfully\n";
} else {
    echo "Error creating table 'animals': " . $conn->error . "\n";
}

// Create the vet_services table with geolocation
$sql = "CREATE TABLE IF NOT EXISTS vet_services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    contact_info VARCHAR(100),
    latitude DECIMAL(10, 8), -- Latitude field for geolocation
    longitude DECIMAL(11, 8), -- Longitude field for geolocation
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'vet_services' created successfully\n";
} else {
    echo "Error creating table 'vet_services': " . $conn->error . "\n";
}

