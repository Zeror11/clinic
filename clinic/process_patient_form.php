<?php
include 'connect.php';

// Process form submission
if (isset($_POST['next'])) { // Check if "Next" button is clicked
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $Occupation = $_POST['Occupation'];
    $Civil_Status = $_POST['Civil_Status']; // New field

    // SQL query to insert data into the database
    $sql = "INSERT INTO `patient registration form` (fullname, age, gender, phone, Occupation, Civil_Status) 
            VALUES ('$fullname', '$age', '$gender', '$phone', '$Occupation', '$Civil_Status')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the next page after successfully saving data
        header("Location: Services button.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
