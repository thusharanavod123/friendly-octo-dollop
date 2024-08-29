<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Farmscap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farm_id = $_POST['farm_id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Animals (farm_id, name, species, age) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $farm_id, $name, $species, $age);

    if ($stmt->execute()) {
        $message = "New animal added successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Animal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Animal</h2>
        <form id="addAnimalForm" method="post" action="">
            <label for="farm_id">Farm ID:</label>
            <input type="number" id="farm_id" name="farm_id" required>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="species">Species:</label>
            <input type="text" id="species" name="species" required>
            
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            
            <input type="submit" value="Add Animal">
        </form>
        <?php
        if ($message != "") {
            echo "<p class='message'>$message</p>";
        }
        ?>
    </div>
    <script>
    document.getElementById('addAnimalForm').addEventListener('submit', function(event) {
        let farmId = document.getElementById('farm_id').value;
        let name = document.getElementById('name').value;
        let species = document.getElementById('species').value;
        let age = document.getElementById('age').value;

        if (!farmId || !name || !species || !age) {
            alert("All fields are required!");
            event.preventDefault();
        }
    });
    </script>
</body>
</html>