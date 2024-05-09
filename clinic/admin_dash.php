<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="admin_dash.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Smile A Lot Dental Clinic</h1>
        <div class="icons">
            <div class="notification-bell">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span id="notification-count" class="badge"></span>
                <!-- Dropdown menu -->
                <div class="dropdown-menu" id="dropdown-menu">
                    <a href="#">No Notification</a>
                </div>
            </div>
        </div>
        <div class="logout-icon">
            <a href="#">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </header>
    <aside>
        <div class="logo">
            <!-- You can use an image -->
            <img src="logo.ico" alt="Logo">
        </div>
        <nav>
    <ul>
        <li class="active"><a href="#"><i class="fas fa-calendar-alt"></i> Appointment Schedule</a></li>
        <li><a href="#"><i class="fas fa-user"></i> Patient Record</a></li>
        <li><a href="#"><i class="fas fa-chart-bar"></i> Analytics</a></li>
        <li><a href="#"><i class="fas fa-file-alt"></i> Reports</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
    </ul>
</nav>

    </aside>
    <main>
    <section id="mainSection">
        <!-- Content will be loaded here -->
    </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

    $(document).ready(function() {
        // Handle click event on "Patient Record" link
        $("nav ul li:nth-child(2) a").click(function(e) { // Assuming "Patient Record" is the second item in the list
            e.preventDefault(); // Prevent default link behavior
            
            // Debugging statement
            console.log("Patient Record link clicked!");

            // Load content from patient info.php into the #content section
            $("#content").load("patient info.php");
        });
    });

        $(document).ready(function() {
            // Function to update notification count and display notifications
            function updateNotificationCount() {
                $.ajax({
                    url: 'bell_retrieve_notifications.php',
                    type: 'GET',
                    dataType: 'json', // Set data type to JSON
                    success: function(data) {
                        var count = data.length; // Get notification count
                        $('#notification-count').text(count); // Update notification count

                        // Toggle badge visibility based on count
                        if (count === 0) {
                            $('#notification-count').addClass('hidden');
                        } else {
                            $('#notification-count').removeClass('hidden');
                        }

                        // Clear previous notifications
                        $("#dropdown-menu").empty();

                        // Display notifications
                        if (count > 0) {
                            $.each(data, function(index, notification) {
                                $("#dropdown-menu").append('<a href="#" class="notification" data-notification-id="' + notification.id + '">' + notification.message + '</a>');
                            });
                        } else {
                            // If no notifications, show default message
                            $("#dropdown-menu").append('<a href="#">No Notifications</a>');
                        }
                    }
                });
            }

            // Initial update
            updateNotificationCount();

            // Toggle the dropdown menu on click
            $(".notification-bell").click(function() {
                $("#dropdown-menu").toggle();
            });

            // Handle click on notifications
            $(document).on('click', '.notification', function() {
                // Mark notification as read
                var notificationId = $(this).data('notification-id');
                markNotificationAsRead(notificationId);
            });

            // Function to mark notification as read
            function markNotificationAsRead(notificationId) {
                $.ajax({
                    url: 'mark_notification_as_read.php',
                    type: 'POST',
                    data: { id: notificationId },
                    success: function(response) {
                        // Update notification count
                        updateNotificationCount();
                    }
                });
            }

            // Hide the dropdown menu if clicked outside
            $(document).click(function(event) {
                if (!$(event.target).closest('.notification-bell').length) {
                    $("#dropdown-menu").hide();
                }
            });
        });


        // JavaScript to handle click event and toggle active class button of appointmet etc
$(document).ready(function() {
    $('nav ul li a').click(function() {
        // Remove the 'active' class from all links
        $('nav ul li').removeClass('active');

        // Add the 'active' class to the clicked link's parent li
        $(this).parent('li').addClass('active');
    });
});

    </script>
</body>
</html>
