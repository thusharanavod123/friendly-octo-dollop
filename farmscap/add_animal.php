<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $birth_date = $_POST['birth_date'];
    $health_status = $_POST['health_status'];

    $sql = "INSERT INTO animals (user_id, name, species, breed, birth_date, health_status) VALUES ('$user_id', '$name', '$species', '$breed', '$birth_date', '$health_status')";
    if ($conn->query($sql) === TRUE) {
        echo "Animal added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>