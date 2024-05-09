<?php
// Include your database connection file
include 'connect.php';

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

// Query to get unread notifications
$sql = "SELECT * FROM `patient registration form` WHERE status = 'new' AND read_status = 0"; // Updated the column names

$result = $conn->query($sql);

$notifications = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Assuming you want to display some information from each new registration
        $notification = array(
            'id' => $row['id'], // Assuming id is the unique identifier for each notification
            'message' => $row['fullname'] // Adjust this to include the relevant information
        );
        $notifications[] = $notification;
    }
}

echo json_encode($notifications);

$conn->close();
?>
