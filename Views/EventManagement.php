<?php

require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Controllers\EventController.php';
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Controllers\LocationController.php';
//loc
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locationController = new LocationController();
    $eventController = new EventController();

    // Step 1: Retrieve form data
    $data = [
        'EventName' => $_POST['EventName'] ?? '',
        'EventDate' => $_POST['EventDate'] ?? '',
        'EventDescription' => $_POST['EventDescription'] ?? '',
        'EventLocation' => $_POST['EventLocation'] ?? '',
        'EventLocationID' => $_POST['EventLocationID'] ?? '',
        'OrganizationName' => 'YourOrganizationName', // Replace with actual logic to fetch the organization name
    ];

    // Step 2: Validate the data
    if (!empty($data['EventName']) && !empty($data['EventDate']) && !empty($data['EventDescription']) && !empty($data['EventLocation'])) {
        // Handle location using LocationController
        $location = $locationController->create_location($data['EventLocation']);
        if ($location) {
            // Set the AddressID for the event
            $data['EventLocationID'] = $location->AddressID;

            // Add the event using EventController
            $success = $eventController->add_event($data);

            if ($success) {
                echo "<p>Event added successfully!</p>";
            } else {
                echo "<p>Failed to add event. Please try again.</p>";
            }
        } else {
            echo "<p>Failed to process the location. Please check the location details.</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }


}

// Instantiate the controller to fetch events
$eventController = new EventController();
$events = $eventController->get_all_events();



// //enlocation
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $data = [
//         'EventName' => $_POST['EventName'] ?? '',
//         'EventDate' => $_POST['EventDate'] ?? '',
//         'EventLocation' => $_POST['EventLocation'] ?? '',
//         'EventDescription' => $_POST['EventDescription'] ?? '',
//         'OrganizationName' => 'YourOrganizationName' // Replace with actual logic to fetch organization name
//     ];

//     // Validate the data
//     if (!empty($data['EventName']) && !empty($data['EventDate']) && !empty($data['EventLocation']) && !empty($data['EventDescription'])) {
//         $eventController = new EventController();
//         $success = $eventController->add_event($data);

//         if ($success) {
//             echo "<p>Event added successfully!</p>";
//         } else {
//             echo "<p>Failed to add event. Please try again.</p>";
//         }
//     } else {
//         echo "<p>All fields are required.</p>";
//     }
// }
// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_event') {
    if (isset($_POST['EventID'])) {
        $eventID = (int)$_POST['EventID'];

        // Call the delete_event function from the controller
        $eventController->delete_event($eventID);

        // Return success response as JSON
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EventID']) && isset($_POST['action']) && $_POST['action'] === 'update_event') {
    // Prepare event data
    $data = [
        'EventID' => $_POST['EventID'],
        'EventName' => $_POST['EventName'],
        'EventDate' => $_POST['EventDate'],
        'EventDescription' => $_POST['EventDescription'],
        'EventLocation' => $_POST['EventLocation'],
        'OrganizationName' => 'YourOrganizationName' // Adjust as needed
    ];
// Call the update_event function from EventController
$eventController = new EventController();
$response = $eventController->update_event($data);

// Return response as JSON
if ($response) {
    echo json_encode(['status' => 'success', 'message' => 'Event updated successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update event.']);
}
exit();

}


// Instantiate the controller
$eventController = new EventController();
$events = $eventController-> get_all_events();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <style>
       body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2a3d4d;
            color: white;
            position: fixed;
            top: 0;
            left: -250px; /* Hidden initially */
            transition: left 0.3s ease;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar.visible {
            left: 0; /* Slide in */
        }
        .sidebar h2 {
            text-align: center;
            margin: 0 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 16px;
            display: block;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #22303d;
        }
        .toggle-btn {
            background-color: #2a3d4d;
            color: white;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
            border-radius: 5px;
            position: absolute;
            top: 5px;
            left: 10px;
            z-index: 1100;
            font-size: 18px;
        }
        .toggle-btn:hover {
            background-color: #22303d;
        }
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease; /* Smooth content shift */
        }
        .content.shifted {
            margin-left: 250px; /* Shifted when sidebar is visible */
        }
        header {
            background-color: #2a3d4d;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        header h1 {
            margin: 0;
            font-size: 18px;
            padding-left: 50px; /* Adjust padding to avoid overlap */
        }
        header nav a {
            color: white;
            text-decoration: none;
            padding: 5px 5px;
        }
        .dummy-data {
            margin-top: 20px;
        }
        .dummy-data h2 {
            color: #2a3d4d;
        }
        .dummy-data table {
            width: 100%;
            border-collapse: collapse;
        }
        .dummy-data th, .dummy-data td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        .dummy-data th {
            background-color: #2a3d4d;
            color: white;
        }
        .add-event-btn {
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #2a3d4d;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-event-btn:hover {
            background-color: #22303d;
        }
        .add-event-form {
            display: none;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        .add-event-form input, .add-event-form textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .add-event-form button {
            background-color: #2a3d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-event-form button:hover {
            background-color: #22303d;
        }
         /* Your existing styles */
         .edit-event-form {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            margin-top: 20px;
        }
        .edit-event-form input, .edit-event-form textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .edit-event-form button {
            background-color: #2a3d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .edit-event-form button:hover {
            background-color: #22303d;
        }
    </style>
    <script>
       // Show the Edit Form and populate the data
       function editEvent(eventID) {
    const eventData = <?php echo json_encode($events); ?>;
    const event = eventData.find(e => String(e.EventID) === String(eventID));

    if (event) {
        // Show the edit form
        const formContainer = document.getElementById('edit-event-container');
        formContainer.style.display = 'block';

        // Populate form fields
        document.getElementById('EventID').value = event.EventID;
        document.getElementById('EventName').value = event.EventName;
        document.getElementById('EventDate').value = event.EventDate;
        document.getElementById('EventDescription').value = event.EventDescription;
        document.getElementById('EventLocation').value = event.EventLocation;
    } else {
        alert("Event not found.");
    }
}


// Submit the form to update the event
function updateEvent() {
    const form = document.getElementById('edit-event-form');
    const formData = new FormData(form);

    formData.append('action', 'update_event');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message);

                // Update the event in the table
                const updatedEvent = response.data; // Assuming updated event is returned in response
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    if (row.querySelector('td').textContent === updatedEvent.EventID) {
                        row.children[1].textContent = updatedEvent.EventName;
                        row.children[2].textContent = updatedEvent.EventDate;
                    }
                });

                // Hide the form
                document.getElementById('edit-event-container').style.display = 'none';
            } else {
                alert(response.message);
            }
        } else {
            alert("Failed to update event.");
        }
    };

    xhr.send(formData);
}



        // Delete event function with confirmation
        function deleteEvent(eventID) {
    if (confirm("Are you sure you want to delete this event?")) {
        const formData = new FormData();
        formData.append('EventID', eventID);
        formData.append('action', 'delete_event'); // Add action to identify the request

        // Create the AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true); // Post to the current page (EventManagement.php)

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.reload(); // Reload the page to reflect the changes
                } else {
                    alert(response.message);
                }
            } else {
                alert("Failed to delete event.");
            }
        };

        xhr.send(formData);
    }
}

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('visible');
            const content = document.querySelector('.content');
            content.classList.toggle('shifted');
        }
        function toggleAddEventForm() {
            const form = document.querySelector('.add-event-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    
    <div class="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Organization Dashboard</h2>
        <a href="organizationView.php">Home</a>
        <a href="create_event.php">Create Event</a>
        <a href="manage_events.php">Manage Events</a>
        <a href="report.php">Reports</a>
        
    </div>
    
    <header>
        <h1>Event Management</h1>
        <nav><a href="home.php">Logout</a></nav>
    </header>
    
    <div class="content">
        <div class="dummy-data">
        <h2>Manage Events</h2>
            <button class="add-event-btn" onclick="toggleAddEventForm()">Add Event</button>

            <!-- Add Event Form -->
            <form class="add-event-form" action="EventManagement.php" method="POST">
    <label for="EventName">Event Name:</label><br>
    <input type="text" id="EventName" name="EventName" required><br>

    <label for="EventDate">Event Date:</label><br>
    <input type="date" id="EventDate" name="EventDate" required><br>

    <label for="EventDescription">Event Description:</label><br>
    <textarea id="EventDescription" name="EventDescription" rows="4" required></textarea><br>

    <label for="EventLocation">Event Location:</label><br>
    <input type="text" id="EventLocation" name="EventLocation" required><br>

    <button type="submit">Save Event</button>
</form>
           
            <table>
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event->EventID); ?></td>
                    <td><?php echo htmlspecialchars($event->EventName); ?></td>
                    <td><?php echo htmlspecialchars($event->EventDate); ?></td>
                    <td><?php echo htmlspecialchars($event->EventLocation->Name); ?></td>
                    <td class="actions">
                            <button onclick="editEvent('<?php echo $event->EventID; ?>')">Edit</button>
                            <button onclick="deleteEvent('<?php echo $event->EventID; ?>')">Delete</button>
                        </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No upcoming events found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
            <!-- Edit Event Form -->
<!-- Hidden Edit Event Form -->
<div id="edit-event-container" style="display: none;">
    <h3>Edit Event</h3>
    <form id="edit-event-form" method="POST">
        <input type="hidden" id="EventID" name="EventID">
        <label for="EventName">Event Name:</label><br>
        <input type="text" id="EventName" name="EventName" required><br>

        <label for="EventDate">Event Date:</label><br>
        <input type="date" id="EventDate" name="EventDate" required><br>

        <label for="EventDescription">Event Description:</label><br>
        <textarea id="EventDescription" name="EventDescription" rows="4" required></textarea><br>

        <label for="EventLocation">Event Location:</label><br>
        <input type="text" id="EventLocation" name="EventLocation" required><br>

        <button type="button" onclick="updateEvent()">Update Event</button>
    </form>
</div>



        </div>
    </div>
</body>
</html>
