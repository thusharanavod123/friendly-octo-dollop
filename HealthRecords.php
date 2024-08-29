<!DOCTYPE html>
<html>
<head>
    <title>Health Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: black;
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        .dark-mode body {
            background-color: #333;
            color: white;
        }
        h2 {
            color: #4CAF50;
            transition: color 0.5s ease;
        }
        .dark-mode h2 {
            color: lightgreen;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        .dark-mode table {
            background-color: rgba(0, 0, 0, 0.8);
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
            cursor: pointer;
        }
        .dark-mode th {
            background-color: #444;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .dark-mode tr:nth-child(even) {
            background-color: #555;
        }
        form {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            transition: background-color 0.5s ease, color 0.5s ease;
        }
        .dark-mode form {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
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
            color: black;
            background-color: white;
        }
        .dark-mode input, .dark-mode textarea {
            color: white;
            background-color: #444;
            border: 1px solid #666;
        }
        input[type="submit"] {
            width: auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .dark-mode input[type="submit"] {
            background-color: #666;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .dark-mode input[type="submit"]:hover {
            background-color: #555;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .search-input {
            margin-top: 20px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .dark-mode .search-input {
            color: white;
            background-color: #444;
            border: 1px solid #666;
        }
        .toggle-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }
        .dark-mode .toggle-button {
            background-color: #666;
        }
        .toggle-button:hover {
            background-color: #45a049;
        }
        .dark-mode .toggle-button:hover {
            background-color: #555;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("healthRecordForm");

            form.addEventListener("submit", function(event) {
                let valid = true;
                let errorMessage = '';

                const animalId = document.getElementById("animal_id").value;
                const healthStatus = document.getElementById("health_status").value;

                if (animalId <= 0) {
                    valid = false;
                    errorMessage += "Animal ID must be a positive number. ";
                }

                if (healthStatus.trim() === '') {
                    valid = false;
                    errorMessage += "Health status cannot be empty. ";
                }

                if (!valid) {
                    event.preventDefault();
                    document.getElementById("error_message").innerText = errorMessage;
                }
            });

            // Function to filter the health records table
            document.getElementById("searchInput").addEventListener("keyup", function() {
                var input = this.value.toUpperCase();
                var table = document.getElementById("healthRecordsTable");
                var tr = table.getElementsByTagName("tr");

                for (var i = 1; i < tr.length; i++) {
                    var td = tr[i].getElementsByTagName("td");
                    var match = false;
                    for (var j = 0; j < td.length; j++) {
                        if (td[j].innerHTML.toUpperCase().indexOf(input) > -1) {
                            match = true;
                            break;
                        }
                    }
                    tr[i].style.display = match ? "" : "none";
                }
            });

            // Function to sort table columns
            function sortTable(n) {
                var table = document.getElementById("healthRecordsTable");
                var rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                switching = true;
                dir = "asc"; 

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];
                        if (dir == "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir == "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        switchcount++; 
                    } else {
                        if (switchcount == 0 && dir == "asc") {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }

            // Attach click event to table headers for sorting
            document.querySelectorAll("#healthRecordsTable th").forEach((header, index) => {
                header.addEventListener("click", () => sortTable(index));
            });

            // Function to toggle dark mode
            function toggleDarkMode() {
                document.body.classList.toggle("dark-mode");
                const button = document.querySelector('.toggle-button');
                if (document.body.classList.contains("dark-mode")) {
                    button.textContent = "Switch to Light Mode";
                } else {
                    button.textContent = "Switch to Dark Mode";
                }
            }

            // Attach click event to the toggle button
            document.querySelector('.toggle-button').addEventListener('click', toggleDarkMode);
        });
    </script>
</head>
<body>
    <button class="toggle-button">Switch to Dark Mode</button>

    <h2>Health Records</h2>

    <input type="text" id="searchInput" class="search-input" placeholder="Search health records...">

    <form id="healthRecordForm" method="POST" action="">
        <div class="form-group">
            <label for="animal_id">Animal ID:</label>
            <input type="number" id="animal_id" name="animal_id" required>
        </div>
        
        <div class="form-group">
            <label for="checkup_date">Checkup Date:</label>
            <input type="date" id="checkup_date" name="checkup_date" required>
        </div>
        
        <div class="form-group">
            <label for="health_status">Health Status:</label>
            <input type="text" id="health_status" name="health_status" required>
        </div>
        
        <div class="form-group">
            <label for="notes">Notes:</label>
            <textarea id="notes" name="notes"></textarea>
        </div>
        
        <input type="submit" value="Add Health Record">
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
        $checkup_date = $_POST["checkup_date"];
        $health_status = $_POST["health_status"];
        $notes = $_POST["notes"];

        $stmt = $conn->prepare("SELECT id FROM Animals WHERE id = ?");
        $stmt->bind_param("i", $animal_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO HealthRecords (animal_id, checkup_date, health_status, notes) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $animal_id, $checkup_date, $health_status, $notes);

            if ($stmt->execute() === TRUE) {
                echo "New health record created successfully";
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

    $sql = "SELECT * FROM HealthRecords";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='healthRecordsTable'><tr><th>ID</th><th>Animal ID</th><th>Checkup Date</th><th>Health Status</th><th>Notes</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["animal_id"]. "</td><td>" . $row["checkup_date"]. "</td><td>" . $row["health_status"]. "</td><td>" . $row["notes"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No health records found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>