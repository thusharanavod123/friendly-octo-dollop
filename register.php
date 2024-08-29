<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$role = $_POST['role']; // The role from the registration form

// Redirect to the appropriate profile page based on the role
if ($role == 'farmer') {
    header('Location: farmer_profile.php');
} elseif ($role == 'vet') {
    header('Location: vet_profile.php');
} elseif ($role == 'AI technician') {
    header('Location: ai_technician_profile.php');
} elseif ($role == 'admin') {
    header('Location: admin_dashboard.php'); // You may want a separate admin dashboard
} else {
    // If something goes wrong, redirect to a default page
    header('Location: index.php');
}
exit();
?>