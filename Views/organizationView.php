

<?php
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Controllers\OrganizationController.php';
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Controllers\EventController.php';
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Controllers\LocationController.php';


echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'No message available.'; 

$email = $_GET['email'] ?? null; // Use OrganizationID from session
$organizationController = new OrganizationController();
echo "email from view issss $email";
if ($email) {
    // Fetch OrganizationID using email
    $organizationID = $organizationController->get_organization_id_by_email($email);
    echo "Organization Id $organizationID";

    if ($organizationID) {
        // Fetch events for the organization using its ID
        $events = $organizationController->get_events_for_organization($organizationID);

        // Display a message including the email and ID
        echo "Welcome, organization with email: " . htmlspecialchars($email) . " (ID: " . htmlspecialchars($organizationID) . ")<br>";

        // Display the events
        if (!empty($events)) {
            echo "Here are your events:<br>";
            foreach ($events as $event) {
                // echo "Event: " . htmlspecialchars($event['EventName']) . ", Date: " . htmlspecialchars($event['EventDate']) . "<br>";
            }
        } else {
            echo "No events found.";
        }
    } else {
        echo "No organization found with the provided email.";
    }
} else {
    echo "Organization email is not set. Please log in again.";
}
if ($organizationID) {
    // Fetch events for the logged-in organization by ID
    $events = $organizationController->get_events_for_organization($organizationID);
} else {
    echo "Organization ID is not set. Please log in again.";
}




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
        'OrganizationID' => $_POST['organizationID'] , // Replace with actual logic to fetch the organization name
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
            $associationSuccess = $organizationController->associate_event_with_organization($data);
            if ($success && $associationSuccess) {
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
// $events = $eventController->get_all_events();

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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organization Dashboard</title>
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
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const externalButton = document.getElementById('external-toggle');

            sidebar.classList.toggle('visible');
            content.classList.toggle('shifted');
            externalButton.style.display = sidebar.classList.contains('visible') ? 'none' : 'block';
        }

        function toggleAddEventForm() {
            const form = document.querySelector('.add-event-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <!-- External Toggle Button to Open Sidebar -->
    <button id="external-toggle" class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Internal Toggle Button to Close Sidebar -->
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Organization Dashboard</h2>
        <a href="events.php">Events</a>
        <a href="reports.php">Reports</a>
        <a href="messages.php">Messages</a>
        <a href="EventManagement.php">Event Management</a>
    </div>

    <!-- Header -->
    <header>
        <h1>Welcome, Organization!</h1>
        <nav>
            <a href="LoginView.php">Logout</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <div class="dummy-data">
            <h2>Upcoming Events</h2>
        
            <button class="add-event-btn" onclick="toggleAddEventForm()">Add Event</button>

            <!-- Add Event Form -->
            <form class="add-event-form" action="organizationView.php" method="POST">
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


            <!-- Event Table -->
            <table>
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Description</th>
          
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
    <tr>
    <td><?php echo htmlspecialchars($event['EventID']); ?></td>
<td><?php echo htmlspecialchars($event['EventName']); ?></td>
<td><?php echo htmlspecialchars($event['EventDate']); ?></td>
<td><?php echo htmlspecialchars($event['EventDescription']); ?></td>



        
    </tr>
<?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="5">No upcoming events found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        </div>
    </div>
</body>
</html>