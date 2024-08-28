<!DOCTYPE html>
<html>
<head>
    <title>Veterinary Appointments</title>
    <style>
        /* Common styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: color 0.3s, background-color 0.3s;
        }

        /* Light mode styles */
        .light-mode {
            background-color: #F0F8FF;
            color: black;
        }

        .light-mode table {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .light-mode th {
            background-color: #f2f2f2;
            color: black;
        }

        .light-mode td {
            color: black;
        }

        .light-mode input[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        .light-mode .error {
            color: red;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #2E2E2E;
            color: white;
        }

        .dark-mode table {
            background-color: #3a3a3a; /* Darker background for better contrast */
        }

        .dark-mode th {
            background-color: #555;
            color: white;
        }

        .dark-mode td {
            color: #e0e0e0; /* Lighter text color for better readability */
        }

        .dark-mode tr:nth-child(even) {
            background-color: #4a4a4a; /* Slightly lighter background for even rows */
        }

        .dark-mode tr:nth-child(odd) {
            background-color: #3a3a3a; /* Maintain consistency in odd rows */
        }

        .dark-mode input[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        .dark-mode .error {
            color: #FF6347;
        }

        /* Common button styles */
        .mode-toggle {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .mode-toggle:hover {
            background-color: #45a049;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        form {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Specific styles for h2 */
        h2 {
            color: #4CAF50; /* Keeping the original color for h2 */
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("appointmentForm");

            form.addEventListener("submit", function(event) {
                let valid = true;
                let errorMessage = '';

                const animalId = document.getElementById("animal_id").value;
                const veterinarianName = document.getElementById("veterinarian_name").value;
                const reason = document.getElementById("reason").value;

                if (animalId <= 0) {
                    valid = false;
                    errorMessage += "Animal ID must be a positive number. ";
                }

                if (veterinarianName.trim() === '') {
                    valid = false;
                    errorMessage += "Veterinarian name cannot be empty. ";
                }

                if (reason.trim() === '') {
                    valid = false;
                    errorMessage += "Reason cannot be empty. ";
                }

                if (!valid) {
                    event.preventDefault();
                    document.getElementById("error_message").innerText = errorMessage;
                }
            });

            // Function to toggle between light and dark modes
            const modeToggle = document.getElementById("modeToggle");
            modeToggle.addEventListener("click", function() {
                const body = document.body;
                if (body.classList.contains("light-mode")) {
                    body.classList.remove("light-mode");
                    body.classList.add("dark-mode");
                    modeToggle.innerText = "Switch to Light Mode";
                } else {
                    body.classList.remove("dark-mode");
                    body.classList.add("light-mode");
                    modeToggle.innerText = "Switch to Dark Mode";
                }
                // Save mode to localStorage
                localStorage.setItem("mode", body.classList.contains("dark-mode") ? "dark" : "light");
            });

            // Initialize mode based on localStorage
            const savedMode = localStorage.getItem("mode");
            if (savedMode === "dark") {
                document.body.classList.add("dark-mode");
                document.body.classList.remove("light-mode");
                modeToggle.innerText = "Switch to Light Mode";
            } else {
                document.body.classList.add("light-mode");
                document.body.classList.remove("dark-mode");
                modeToggle.innerText = "Switch to Dark Mode";
            }
        });
    </script>
</head>
<body>
    <button id="modeToggle" class="mode-toggle">Switch to Dark Mode</button>
    
    <h2>Veterinary Appointments</h2>
    
    <form id="appointmentForm" method="POST" action="">
        <div class="form-group">
            <label for="animal_id">Animal ID:</label>
            <input type="number" id="animal_id" name="animal_id" required>
        </div>
        
        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>
        </div>
        
        <div class="form-group">
            <label for="veterinarian_name">Veterinarian Name:</label>
            <input type="text" id="veterinarian_name" name="vet_name" required>
        </div>
        
        <div class="form-group">
            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason_for_visit" required></textarea>
        </div>
        
        <input type="submit" value="Add Appointment">
        <div id="error_message" class="error"></div>
    </form>

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
        $appointment_date = $_POST["appointment_date"];
        $vet_name = $_POST["vet_name"];
        $reason_for_visit = $_POST["reason_for_visit"];

        $stmt = $conn->prepare("SELECT id FROM Animals WHERE id = ?");
        $stmt->bind_param("i", $animal_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO VeterinaryAppointments (animal_id, appointment_date, vet_name, reason_for_visit) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $animal_id, $appointment_date, $vet_name, $reason_for_visit);

            if ($stmt->execute() === TRUE) {
                echo "New appointment created successfully";
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

    $sql = "SELECT * FROM VeterinaryAppointments";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Animal ID</th><th>Appointment Date</th><th>Veterinarian Name</th><th>Reason</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["animal_id"]. "</td><td>" . $row["appointment_date"]. "</td><td>" . $row["vet_name"]. "</td><td>" . $row["reason_for_visit"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No appointments found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>