<?php
include 'connect.php';

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Get the ID of the record to update
    $id = $_GET['id'];

    // Retrieve form data
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address']; // Added address field
    $allergic = $_POST['allergic']; // Added allergic field
    $medical_record = $_POST['medical_record'];
    $insurance_info = $_POST['insurance_info'];

    // Prepare SQL statement to update the record
    $sql = "UPDATE `patient registration form` SET  
                fullname = '$fullname',
                age = '$age',
                gender = '$gender',
                phone = '$phone',
                email = '$email',
                address = '$address', 
                allergic = '$allergic', 
                medical_record = '$medical_record',
                insurance_info = '$insurance_info'
            WHERE id='$id'";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // If update is successful, redirect to the page where records are displayed
        header("Location: patient info.php");
        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating record: " . $conn->error;
    }
} else {
    // If form is not submitted via POST method or ID is not provided, redirect back
    header("Location: patient info.php");
    exit();
}

$conn->close();
?>
