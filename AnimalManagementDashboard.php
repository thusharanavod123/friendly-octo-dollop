<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Farmscap";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Start session and check if the user is authenticated
session_start();

// Fetch feed schedules from the database
$feed_schedules_query = "SELECT * FROM feedschedules ORDER BY feed_time DESC";
$feed_schedules_result = mysqli_query($conn, $feed_schedules_query);

// Fetch health records from the database
$health_records_query = "SELECT * FROM healthrecords ORDER BY checkup_date DESC";
$health_records_result = mysqli_query($conn, $health_records_query);

// Fetch veterinary appointments from the database
$veterinary_appointments_query = "SELECT * FROM veterinaryappointments ORDER BY appointment_date DESC";
$veterinary_appointments_result = mysqli_query($conn, $veterinary_appointments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('https://media.istockphoto.com/id/944687452/photo/dairy-farm-cows-indoor-in-the-shed.webp?b=1&s=170667a&w=0&k=20&c=X1Bjg93qOe-lUb8FWZzLl24OOW6YP75jS0e8iEwDVx8=');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: background-color 0.5s ease;
}

.dashboard-container {
    width: 80%;
    margin: auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.5s ease, color 0.5s ease;
}

.dark-mode .dashboard-container {
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
}

.dark-mode body {
    background-color: #333;
    color: #fff;
}

h1 {
    color: maroon;
    transition: color 0.5s ease;
}

.dark-mode h1 {
    color: lightcoral;
}

h2 {
    color: green;
    transition: color 0.5s ease;
}

.dark-mode h2 {
    color: lightgreen;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    transition: background-color 0.5s ease, color 0.5s ease;
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

tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

.dark-mode th {
    background-color: #444;
}

.dark-mode tr:nth-child(even) {
    background-color: #555;
}

.dark-mode table tr:hover {
    background-color: #666;
}

.navbar {
    background-color: maroon;
    padding: 10px;
    text-align: center;
}

.navbar a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navbar a:hover {
    color: lightcoral;
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

.toggle-button:hover {
    background-color: #45a049;
}
</style>
<body>
    <div class="navbar">
        <a href="#feedSchedules">Feed Schedules</a>
        <a href="#healthRecords">Health Records</a>
        <a href="#veterinaryAppointments">Veterinary Appointments</a>
        <button class="toggle-button" id="darkModeToggle" onclick="toggleDarkMode()">Switch to Dark Mode</button>
    </div>

    <div class="dashboard-container">
        <h1>Dashboard</h1>

        <!-- Feed Schedules Section -->
        <section id="feedSchedules">
            <h2>Feed Schedules</h2>
            <input type="text" id="feedSchedulesInput" onkeyup="filterFeedSchedules()" placeholder="Search for feed schedules..">
            <table id="feedSchedulesTable">
                <tr>
                    <th onclick="sortTable(0, 'feedSchedulesTable')">Animal ID</th>
                    <th onclick="sortTable(1, 'feedSchedulesTable')">Feed Time</th>
                    <th onclick="sortTable(2, 'feedSchedulesTable')">Feed Type</th>
                    <th onclick="sortTable(3, 'feedSchedulesTable')">Quantity</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($feed_schedules_result)): ?>
                <tr>
                    <td><?php echo $row['animal_id']; ?></td>
                    <td><?php echo $row['feed_time']; ?></td>
                    <td><?php echo $row['feed_type']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>

        <!-- Health Records Section -->
        <section id="healthRecords">
            <h2>Health Records</h2>
            <input type="text" id="healthRecordsInput" onkeyup="filterHealthRecords()" placeholder="Search for health records..">
            <table id="healthRecordsTable">
                <tr>
                    <th onclick="sortTable(0, 'healthRecordsTable')">Animal ID</th>
                    <th onclick="sortTable(1, 'healthRecordsTable')">Checkup Date</th>
                    <th onclick="sortTable(2, 'healthRecordsTable')">Health Status</th>
                    <th onclick="sortTable(3, 'healthRecordsTable')">Notes</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($health_records_result)): ?>
                <tr>
                    <td><?php echo $row['animal_id']; ?></td>
                    <td><?php echo $row['checkup_date']; ?></td>
                    <td><?php echo $row['health_status']; ?></td>
                    <td><?php echo $row['notes']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>

        <!-- Veterinary Appointments Section -->
        <section id="veterinaryAppointments">
            <h2>Veterinary Appointments</h2>
            <input type="text" id="veterinaryAppointmentsInput" onkeyup="filterVeterinaryAppointments()" placeholder="Search for appointments..">
            <table id="veterinaryAppointmentsTable">
                <tr>
                    <th onclick="sortTable(0, 'veterinaryAppointmentsTable')">Animal ID</th>
                    <th onclick="sortTable(1, 'veterinaryAppointmentsTable')">Appointment Date</th>
                    <th onclick="sortTable(2, 'veterinaryAppointmentsTable')">Veterinarian Name</th>
                    <th onclick="sortTable(3, 'veterinaryAppointmentsTable')">Reason</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($veterinary_appointments_result)): ?>
                <tr>
                    <td><?php echo $row['animal_id']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['vet_name']; ?></td>
                    <td><?php echo $row['reason_for_visit']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </div>

    <script>
// Function to filter the Feed Schedules table
function filterFeedSchedules() {
    var input = document.getElementById("feedSchedulesInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("feedSchedulesTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td");
        var match = false;
        for (var j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        tr[i].style.display = match ? "" : "none";
    }
}

// Function to filter the Health Records table
function filterHealthRecords() {
    var input = document.getElementById("healthRecordsInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("healthRecordsTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td");
        var match = false;
        for (var j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        tr[i].style.display = match ? "" : "none";
    }
}

// Function to filter the Veterinary Appointments table
function filterVeterinaryAppointments() {
    var input = document.getElementById("veterinaryAppointmentsInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("veterinaryAppointmentsTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td");
        var match = false;
        for (var j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        tr[i].style.display = match ? "" : "none";
    }
}

// Function to sort table columns
function sortTable(n, tableId) {
    var table = document.getElementById(tableId);
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

// Function to toggle dark mode and update button text
function toggleDarkMode() {
    var body = document.body;
    var button = document.getElementById("darkModeToggle");
    
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        button.textContent = "Switch to Light Mode";
    } else {
        button.textContent = "Switch to Dark Mode";
    }
}

// Initialize button text based on current mode
function initializeDarkModeButton() {
    var body = document.body;
    var button = document.getElementById("darkModeToggle");
    
    if (body.classList.contains("dark-mode")) {
        button.textContent = "Switch to Light Mode";
    } else {
        button.textContent = "Switch to Dark Mode";
    }
}

// Call the initialize function on page load
initializeDarkModeButton();

// Smooth scroll for navigation
document.querySelectorAll('.navbar a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>