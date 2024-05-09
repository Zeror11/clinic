<?php
// Include database connection
include 'connect.php';

// Process form submission
if (isset($_POST['submit'])) { // Check if "Submit" button is clicked
   
    $Date = $_POST['Date'];
    $Time = $_POST['Time']; // New field

    // SQL query to insert data into the database
    $sql = "INSERT INTO `date_time` (Date, Time) 
VALUES ('$Date', '$Time')";

if ($conn->query($sql) === TRUE) {
// Redirect to the next page after successfully saving data
header("Location: index.html");
exit();
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
$conn->close();
?>