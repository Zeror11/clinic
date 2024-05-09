    function toggleTable() {
    var tableContainer = document.getElementById('tableContainer');
    var searchbar = document.querySelector('.search-bar');
    var refreshButton = document.querySelector('.refresh-button');
    
    if (tableContainer.style.display === 'none') {
        tableContainer.style.display = 'block';
        searchbar.style.display = 'block';
        refreshButton.style.display = 'block';
    } else {
        tableContainer.style.display = 'none';
        searchbar.style.display = 'none';
        refreshButton.style.display = 'none';
        searchInput.value = ''; // Reset the search field
    }
}
    

    //refresh
    function refreshTable() {
    location.reload(); // Reload the page to refresh the table and retrieve the latest data
}

function editRow(id) {
    // Retrieve the data of the selected row using AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Parse the JSON response
            var rowData = JSON.parse(this.responseText);
            // Populate form fields with the retrieved data
                document.getElementsByName('fullname')[0].value = rowData.fullname;
                document.getElementsByName('age')[0].value = rowData.age;
                // Set the checked attribute for the appropriate radio button based on the retrieved gender value
                if (rowData.gender === 'male') {
                    document.getElementById('male').checked = true;
                } else if (rowData.gender === 'female') {
                    document.getElementById('female').checked = true;
                } else {
                    document.getElementById('other').checked = true;
                }
                document.getElementsByName('phone')[0].value = rowData.phone;
                document.getElementsByName('email')[0].value = rowData.email;
                document.getElementsByName('address')[0].value = rowData.address; // Populate address field
                document.getElementsByName('allergic')[0].value = rowData.allergic; // Populate allergic field
                document.getElementsByName('medical_record')[0].value = rowData.medical_record;
                document.getElementsByName('insurance_info')[0].value = rowData.insurance_info;
           // Change form action to indicate editing mode
            document.getElementById('recordForm').action = 'patient info_update row.php?id=' + id; // Change action to update_row.php
            // Change submit button text to 'Update Record'
            document.getElementById('submitBtn').value = 'Update Record';
        }
    };
    xhttp.open("GET", "patient info_edit.php?id=" + id, true);
    xhttp.send();
}


        function deleteRow(id) {
    // Show confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete row with ID: " + id + "?");
    if (confirmDelete) {
        // Send AJAX request to delete row
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Refresh the table after successful deletion
                refreshTable();
            }
        };
        xhttp.open("POST", "patient info_delete.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
    }
}



    //search ID, FNAME
    function search() {
    var input, filter, table, tr, td, i, txtValue, found;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("recordsTable");
    tr = table.getElementsByTagName("tr");
    found = false; // Flag to track if any records were found

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        tdId = tr[i].getElementsByTagName("td")[0]; // Get the ID cell
        tdName = tr[i].getElementsByTagName("td")[1]; // Get the Full Name cell
        if (tdId || tdName) {
            txtValueId = tdId.textContent || tdId.innerText;
            txtValueName = tdName.textContent || tdName.innerText;
            if (txtValueId.toUpperCase().indexOf(filter) > -1 || txtValueName.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                found = true; // Set the flag to true if a record is found
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    // Show a message if no records were found
    if (!found) {
        document.getElementById("noRecordsFound").style.display = "block";
    } else {
        document.getElementById("noRecordsFound").style.display = "none";
    }
}

