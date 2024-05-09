<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to retrieve row data based on ID
    $sql_select_row = "SELECT * FROM `patient registration form` WHERE id = $id";
    $result = $conn->query($sql_select_row);

    if ($result && $result->num_rows > 0) {
        // Fetch the row data
        $row = $result->fetch_assoc();
        // Convert row data to JSON format
        $json_data = json_encode($row);
        // Output JSON data
        echo $json_data;
    } else {
        // If no row found with the given ID, return an empty JSON object
        echo json_encode(array());
    }
} else {
    // If ID is not provided or request method is not GET, return an empty JSON object
    echo json_encode(array());
}

$conn->close();
?>
