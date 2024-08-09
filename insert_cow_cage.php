<?php
  include 'db_connection.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cageid= $_POST['Cageid'];
  $cownumber = $_POST['CowNumber'];

$sql = "INSERT INTO cowCage (Cageid, CowNumber) VALUES ('$cageid','$cownumber') ";


if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Cage details added successfully.'); window.location.href = 'cowcage.html';</script>";

  //window.location.href is a property that can be set to navigate to a different URL.

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close connection
$conn->close();
