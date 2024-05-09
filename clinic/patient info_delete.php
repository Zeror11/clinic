<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete the row from the database
    $sql_delete = "DELETE FROM `patient registration form` WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        // Reorder the IDs
        $sql_update_ids = "SET @num := 0; UPDATE `patient registration form` SET id = @num := (@num+1); ALTER TABLE `patient registration form` AUTO_INCREMENT = 1";
        if ($conn->multi_query($sql_update_ids) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
