<?php
// Include your database connection file
include 'connect.php';

// Get notification id from POST request
$notificationId = $_POST['id'];

// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "smile a lot dental clinic"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update read status of the notification
$sql = "UPDATE `patient registration form` SET read_status = 1 WHERE id = $notificationId"; // Assuming 'id' is the primary key of your table
if ($conn->query($sql) === TRUE) {
    echo "Notification marked as read successfully";
} else {
    echo "Error marking notification as read: " . $conn->error;
}

$conn->close();
?>
