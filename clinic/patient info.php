<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="patient info.css">
    <script src="patient info.js"></script>

</head>
    <body> 
        <section>
            <?php
                include 'connect.php';

                // If form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if the form is in 'Add Record' mode or 'Update Record' mode
                    if ($_POST['submitBtn'] == 'Add Record') {
                        // Add record logic
                        $fullname = $_POST['fullname'];
                        $age = $_POST['age'];
                        $gender = $_POST['gender'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $address = $_POST['address']; // Added address field
                        $allergic = $_POST['allergic']; // Added allergic field
                        $medical_record = $_POST['medical_record'];
                        $insurance_info = $_POST['insurance_info'];
                
                        // SQL query to insert data into the database
                        $sql = "INSERT INTO `patient registration form` (fullname, age, gender, phone, email, address, allergic, medical_record, insurance_info) 
                                VALUES ('$fullname', '$age', '$gender', '$phone', '$email', '$address', '$allergic', '$medical_record', '$insurance_info')";
                
                        if ($conn->query($sql) === TRUE) {
                            echo "New record added successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } elseif ($_POST['submitBtn'] == 'Update Record') {
                        // Update record logic
                        $id = $_GET['id']; // Get the ID from the URL parameter
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

                
                        if ($conn->query($sql) === TRUE) {
                            echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                }

                      // If a record deletion request is received
                     if (isset($_POST['delete_id'])) {
                    $delete_id = $_POST['delete_id'];

                    // SQL query to delete the record with the given ID
                    $sql_delete = "DELETE FROM `patient registration form` WHERE id = $delete_id";
                    if ($conn->query($sql_delete) === TRUE) {
                        // SQL query to retrieve all records from the database
                        $sql_select_all = "SELECT * FROM `patient registration form`";
                        $result_all = $conn->query($sql_select_all);
                        
                        // Counter for new IDs
                        $new_id = 1;

                        // Loop through all records and update their IDs
                        while ($row = $result_all->fetch_assoc()) {
                            // Update the ID of the current record
                            $current_id = $row['id'];
                            $sql_update_id = "UPDATE `patient registration form` SET id = $new_id WHERE id = $current_id";
                            $conn->query($sql_update_id);

                            // Increment the new ID
                            $new_id++;
                        }

                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                // SQL query to retrieve data from the database
                $sql_select = "SELECT * FROM `patient registration form`";
                $result = $conn->query($sql_select);
            ?>
            
            <div class="container">
            <h2>Record Form</h2>
            <form method="post" id="recordForm" onsubmit="clearForm();">
            <div class="left-section">
            <h3>Personal Information</h3>
            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" required>
            <br>
            <label for="age">Age:</label>
            <input type="text" name="age" required>
            <br>
            <label>Gender:</label>
            <div class="gender">
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="Other">
                <label for="other">Other</label>
            </div>
            <br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" required>
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" required>
            <br>
            <label for="address">Address:</label> <!-- Added address field -->
            <input type="text" name="address" required> <!-- Added address input -->
            <br>
            <label for="allergic">Allergic:</label> <!-- Added allergic field -->
            <input type="text" name="allergic" required> <!-- Added allergic input -->
        </div>
        <div class="right-section">
            <h3>Appointment Information</h3>
            <!-- Removed appointment_date and appointment_time fields -->
            <label for="medical_record">Medical Record:</label>
            <input type="text" name="medical_record" required>
            <br>
            <label for="insurance_info">Insurance Info:</label>
            <input type="text" name="insurance_info" required>
        </div>
        <input type="submit" name="submitBtn" id="submitBtn" value="Add Record">
    </form>
</div>


            <?php
            // Process form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Handle form submission here...

                // Redirect to a different page after form submission
                header("Location: patient info.php"); // Redirect to a success page
                exit; // Ensure script execution stops here to prevent further output
            }

    // Define the array to store records
    $records = array();

    // Fetch records from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Store each record in the array
            $records[] = $row;
        }
    }

    // Display sorted records in the table
if (!empty($records)) {
    echo "<button class='toggle-button' onclick='toggleTable()'>SHOW RECORD TABLE</button>"; // Button for toggling visibility
    echo "<div class='table-container' id='tableContainer' style='display: none;'>"; // Hide the table by default
    
    
    echo "<div class='search-bar' style='display: none;'>"; // Hide the search bar by default
    echo "<input type='text' id='searchInput' placeholder='Search...'>";
    echo "<button onclick='search()'>Search</button>";
    echo "</div>";


    echo "<div class='refresh-button' style='display: none;'>"; // Hide the refresh button by default
    echo "<button onclick='refreshTable()'>Refresh</button>";
    echo "</div>"; // End of refresh-button
    

    echo "<div class='table-wrapper'>"; // Add a wrapper for the table with fixed height and scroll
    echo "<table id='recordsTable'>"; // Remove inline style for the table

    
    echo "<tr><th>ID</th><th>Full Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Email</th><th>Address</th><th>Allergic</th><th>Medical Record</th><th>Insurance Info</th></tr>";

    foreach ($records as $row) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>"; // Display ID
        echo "<td>".$row["fullname"]."</td>";
        echo "<td>".$row["age"]."</td>";
        echo "<td>".$row["gender"]."</td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["address"]."</td>"; // Display Address
        echo "<td>".$row["allergic"]."</td>"; // Display Allergic
        echo "<td>".$row["medical_record"]."</td>";
        echo "<td>".$row["insurance_info"]."</td>";
        echo "<td><button class='edit-btn' onclick='editRow(".$row['id'].")'>Edit</button></td>"; // Edit button
        echo "<td><button class='delete-btn' onclick='deleteRow(".$row['id'].")'>Delete</button></td>"; // Delete button    
        echo "</tr>";
    }
    

    echo "</table>";

    echo "<div id='noRecordsFound' style='display: none;'>No records found</div>";

    echo "</div>"; // End of table-wrapper
    echo "</div>"; // End of table-container

} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>          
        </section> 
</body>
</html>