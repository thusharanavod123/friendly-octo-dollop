<!DOCTYPE html>
<html>
<head>
    <title>Feed Schedules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }
        body.dark-mode {
            background-color: #121212;
            color: white;
            background-image: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=');
        }
        h2 {
            color: maroon;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
        }
        body.dark-mode table {
            background-color: rgba(50, 50, 50, 0.8);
            color: white;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        body.dark-mode th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        body.dark-mode tr:nth-child(even) {
            background-color: #444;
        }
        form {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            color: black;
        }
        body.dark-mode form {
            background-color: rgba(50, 50, 50, 0.8);
            color: white;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-group label {
            margin-right: 10px;
            width: auto;
        }
        input, select {
            padding: 8px;
            box-sizing: border-box;
            color: black;
        }
        body.dark-mode input, body.dark-mode select {
            color: white;
            background-color: #333;
        }
        .time-input {
            width: auto;
            margin-right: 5px;
        }
        .animal-id-input {
            width: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: maroon;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        body.dark-mode input[type="submit"] {
            background-color: #0056b3;
            color: white;
        }
        body.dark-mode input[type="submit"]:hover {
            background-color: #004494;
        }
        #darkModeToggle {
            margin-top: 20px;
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #darkModeToggle:hover {
            background-color: #007B9A;
        }
        body.dark-mode #darkModeToggle {
            background-color: #333;
            color: white;
        }
        body.dark-mode #darkModeToggle:hover {
            background-color: #444;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("feedScheduleForm");
            const darkModeToggle = document.getElementById("darkModeToggle");

            // Check local storage for dark mode preference
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                darkModeToggle.textContent = "Switch to Light Mode";
            }

            form.addEventListener("submit", function(event) {
                const animalId = document.getElementById("animal_id").value;
                const quantity = document.getElementById("quantity").value;

                if (animalId <= 0 || quantity <= 0) {
                    alert("Please enter valid values for Animal ID and Quantity.");
                    event.preventDefault();
                }
            });

            darkModeToggle.addEventListener("click", function() {
                document.body.classList.toggle("dark-mode");

                // Update button text
                if (document.body.classList.contains("dark-mode")) {
                    darkModeToggle.textContent = "Switch to Light Mode";
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    darkModeToggle.textContent = "Switch to Dark Mode";
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        });
    </script>
</head>
<body>
    <h2>Feed Schedules</h2>
    
    <form id="feedScheduleForm" method="POST" action="">
        <div class="form-group">
            <label for="animal_id">Animal ID:</label>
            <input type="number" id="animal_id" name="animal_id" class="animal-id-input" required>
        </div>
        
        <div class="form-group">
            <label>Feed Time:</label>
            <select id="hour" name="hour" class="time-input" required>
                <?php
                for ($i = 0; $i <= 23; $i++) {
                    printf('<option value="%02d">%02d</option>', $i, $i);
                }
                ?>
            </select> :
            <select id="minute" name="minute" class="time-input" required>
                <?php
                for ($i = 0; $i <= 59; $i++) {
                    printf('<option value="%02d">%02d</option>', $i, $i);
                }
                ?>
            </select> :
            <select id="second" name="second" class="time-input" required>
                <?php
                for ($i = 0; $i <= 59; $i++) {
                    printf('<option value="%02d">%02d</option>', $i, $i);
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="feed_type">Feed Type:</label>
            <select id="feed_type" name="feed_type" required>
                <option value="Paddy Straw">Paddy Straw</option>
                <option value="Coconut Poonac">Coconut Poonac</option>
                <option value="Rice Bran">Rice Bran</option>
                <option value="Gliricidia">Gliricidia</option>
                <option value="Jak Fruit Leaves">Jak Fruit Leaves</option>
                <option value="Banana Stems and Leaves">Banana Stems and Leaves</option>
                <option value="Brewers' Spent Grain">Brewers' Spent Grain</option>
                <option value="Coconut Husk and Shell">Coconut Husk and Shell</option>
                <option value="Cattle Fattening Mix">Cattle Fattening Mix</option>
                <option value="Poultry Feed">Poultry Feed</option>
                <option value="Sesame Poonac">Sesame Poonac</option>
                <option value="King Grass">King Grass (Pennisetum purpureum)</option>
                <option value="Sugarcane Tops">Sugarcane Tops</option>
                <option value="Coconut Water">Coconut Water</option>
                <option value="Legume Hay">Legume Hay (such as Desmodium)</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" step="0.01" required>
        </div>
        
        <input type="submit" value="Add Feed Schedule">
    </form>

    <button id="darkModeToggle">Switch to Dark Mode</button>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Farmscap";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $animal_id = $_POST["animal_id"];
        $hour = $_POST["hour"];
        $minute = $_POST["minute"];
        $second = $_POST["second"];
        $feed_time = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
        $feed_type = $_POST["feed_type"];
        $quantity = $_POST["quantity"];

        $stmt = $conn->prepare("SELECT id FROM Animals WHERE id = ?");
        $stmt->bind_param("i", $animal_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO FeedSchedules (animal_id, feed_time, feed_type, quantity) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $animal_id, $feed_time, $feed_type, $quantity);

            if ($stmt->execute() === TRUE) {
                echo "New feed schedule created successfully";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error: Animal ID does not exist.";
        }
        $stmt->close();
    }

    $sql = "SELECT * FROM FeedSchedules";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Animal ID</th><th>Feed Time</th><th>Feed Type</th><th>Quantity</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["animal_id"]. "</td><td>" . $row["feed_time"]. "</td><td>" . $row["feed_type"]. "</td><td>" . $row["quantity"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No feed schedules found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>