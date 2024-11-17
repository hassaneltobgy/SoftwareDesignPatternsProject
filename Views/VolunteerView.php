<?php
require_once '../Controllers/VolunteerController.php';

// Instantiate the controller
$controller = new VolunteerController();
$volunteers = $controller->getAllVolunteers();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Management Platform</title>
    <link rel="stylesheet" href="./Style/style_control_panel.css">
</head>
<body>
<div id="mySidebar" class="sidebar">
        <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
        <a href="NotificationView.php">Notifications</a>
        <a href="LoginView.php" onclick="logout()">Logout</a>
    </div>

    <span class="open-btn" onclick="openNav()">&#9776;</span> <!-- Hamburger icon to open sidebar -->

    <script>
    function openNav() {
    // Move sidebar into view
    document.getElementById("mySidebar").style.left = "0";

    // Adjust the container to account for the sidebar
    const container = document.querySelector('.container');
    container.style.marginLeft = "250px";
    container.style.width = "calc(100% - 250px)"; // Dynamically adjust width
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease"; // Smooth transition
}

function closeNav() {
    // Hide the sidebar
    document.getElementById("mySidebar").style.left = "-250px";

    // Reset container position and width
    const container = document.querySelector('.container');
    container.style.marginLeft = "auto";
    container.style.width = "80%"; // Reset to centered layout width
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease"; // Smooth transition
}

function logout() {
    window.location.href = 'LoginView.php'; // Redirect to login page
}
</script>
    <div class="container">
        <h1>Volunteer Management Platform</h1>
        <h2>Add New Volunteer</h2>

        <form id="volunteerForm" action="VolunteerView.php" method="post">
            <input type="hidden" name="action" value="addUserAndVolunteer">

            <!-- User Information -->
            <div class="form-group">
                <label for="FirstName">First Name</label>
                <input type="text" id="FirstName" name="FirstName" required>
            </div>

            <div class="form-group">
                <label for="LastName">Last Name</label>
                <input type="text" id="LastName" name="LastName" required>
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" required>
            </div>

            <div class="form-group">
                <label for="PhoneNumber">Phone Number</label>
                <input type="tel" id="PhoneNumber" name="PhoneNumber" required>
            </div>

            <div class="form-group">
                <label for="DateOfBirth">Date of Birth</label>
                <input type="date" id="DateOfBirth" name="DateOfBirth" required>
            </div>

            <!-- Account Information -->
            <div class="form-group">
                <label for="USER_NAME">Username</label>
                <input type="text" id="USER_NAME" name="USER_NAME">
            </div>

            <div class="form-group">
                <label for="PASSWORD_HASH">Password</label>
                <input type="password" id="PASSWORD_HASH" name="PASSWORD_HASH">
            </div>

            <div class="form-group">
                <label for="LAST_LOGIN">Last Login</label>
                <input type="datetime-local" id="LAST_LOGIN" name="LAST_LOGIN">
            </div>

            <div class="form-group">
                <label for="ACCOUNT_CREATION_DATE">Account Creation Date</label>
                <input type="datetime-local" id="ACCOUNT_CREATION_DATE" name="ACCOUNT_CREATION_DATE">
            </div>

            <!-- Volunteer Specific Information -->
            <div class="form-group">
                <label for="hours_contributed">Hours Contributed</label>
                <input type="number" id="hours_contributed" name="hours_contributed" required>
            </div>

            <div class="form-group">
                <label for="NumberOfEventsAttended">Number of Events Attended</label>
                <input type="number" id="NumberOfEventsAttended" name="NumberOfEventsAttended" required>
            </div>

            <div class="form-group">
                <label for="badge_name">Badge</label>
                <input type="text" id="badge_name" name="badge_name">
            </div>

            <div class="form-group">
                <label for="skills">Skills</label>
                <input type="text" id="skills" name="skills">
            </div>

            <div class="form-group">
                <label for="volunteer_history">Volunteer History</label>
                <input type="text" id="volunteer_history" name="volunteer_history">
            </div>

            <button type="submit" class="button">Add Volunteer</button>
        </form>

       
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Volunteer</h2>

        <form id="editVolunteerForm" action = "VolunteerView.php" method="post">

        <input type="hidden" name="action" value="updateVolunteer">
            <input type="hidden" id="editVolunteerId" name="VolunteerID">
            
            <div class="form-group">
                <label for="editFirstName">First Name</label>
                <input type="text" id="editFirstName" name="FirstName" required>
            </div>
            
            <div class="form-group">
                <label for="editLastName">Last Name</label>
                <input type="text" id="editLastName" name="LastName" required>
            </div>
            
            <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" name="Email" required>
            </div>
            
            <div class="form-group">
                <label for="editPhoneNumber">Phone Number</label>
                <input type="tel" id="editPhoneNumber" name="PhoneNumber" required>
            </div>
            
            <div class="form-group">
                <label for="editDateOfBirth">Date of Birth</label>
                <input type="date" id="editDateOfBirth" name="DateOfBirth" required>
            </div>
            
            <div class="form-group">
                <label for="editUserName">Username</label>
                <input type="text" id="editUserName" name="USER_NAME">
            </div>
            
            <div class="form-group">
                <label for="editPasswordHash">Password</label>
                <input type="password" id="editPasswordHash" name="PASSWORD_HASH">
            </div>
            
            <div class="form-group">
                <label for="editHoursContributed">Hours Contributed</label>
                <input type="number" id="editHoursContributed" name="hours_contributed" required>
            </div>
            
            <div class="form-group">
                <label for="editNumberOfEventsAttended">Number of Events Attended</label>
                <input type="number" id="editNumberOfEventsAttended" name="NumberOfEventsAttended" required>
            </div>
            <div class="form-group">
                <label for="badge_name">Badge</label>
                <input type="text" id="editBadgeName" name="badge_name">
            </div>
            
            <button type="submit" class="button" onclick="closeModal()">Save Changes</button>
        </form>
    </div>
</div>



        <!-- CRUD Table -->
        <h2>Manage Volunteers</h2>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Hours Contributed</th>
                    <th>Events Attended</th>
                    <th>Badge</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($volunteers as $volunteer): ?>
        <tr data-id="<?= $volunteer->UserID; ?>">

        <td class="volunteerId"><?= $volunteer->VolunteerID; ?></td>
        <td class= "firstName"><?= $volunteer->FirstName; ?></td>
        <td class="lastName"><?= $volunteer->LastName; ?></td>
        <td class="email"><?= $volunteer->Email; ?></td>    
        <td class="phone"><?= $volunteer->PhoneNumber; ?></td>
        <td class="hours"><?= $volunteer->hours_contributed; ?></td>
        <td class="events"><?= $volunteer->NumberOfEventsAttended; ?></td>
        <td><?= $volunteer->badge->get_title(); ?></td>
        <td>
            <button type="button" onclick="openModal(<?= $volunteer->VolunteerID; ?>,'<?= $volunteer->badge->get_title(); ?>', '<?= $volunteer->FirstName; ?>', '<?= $volunteer->LastName; ?>', '<?= $volunteer->Email; ?>', '<?= $volunteer->PhoneNumber; ?>', '<?= $volunteer->DateOfBirth; ?>', '<?= $volunteer->USER_NAME; ?>', '<?= $volunteer->PASSWORD_HASH; ?>', '<?= $volunteer->hours_contributed; ?>', '<?= $volunteer->NumberOfEventsAttended; ?>')">Edit</button>
            <form method="POST" action="VolunteerView.php" onsubmit="return confirm('Are you sure you want to delete this volunteer?');" style="display:inline;">
            <input type="hidden" name="action" value="deleteVolunteer">
            <input type="hidden" name="VolunteerID" value="<?= $volunteer->UserID; ?>">
    <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline;">Delete</button>
</form>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>

   
</body>
</html>

<script>
    // Function to open the modal and populate the form fields
    function openModal(volunteerId,badge_name, firstName, lastName, email, phoneNumber, dateOfBirth, userName, passwordHash, hoursContributed, numberOfEventsAttended) {
        // Set the values for the form fields
        document.getElementById("editVolunteerId").value = volunteerId;
        document.getElementById("editBadgeName").value = badge_name;
        document.getElementById("editFirstName").value = firstName;
        document.getElementById("editLastName").value = lastName;
        document.getElementById("editEmail").value = email;
        document.getElementById("editPhoneNumber").value = phoneNumber;
        document.getElementById("editDateOfBirth").value = dateOfBirth;
        document.getElementById("editUserName").value = userName;
        document.getElementById("editPasswordHash").value = passwordHash;
        document.getElementById("editHoursContributed").value = hoursContributed;
        document.getElementById("editNumberOfEventsAttended").value = numberOfEventsAttended;

        // Show the modal
        document.getElementById("editModal").style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        const modal = document.getElementById("editModal");
        if (modal) {
            modal.style.display = "none";
        } else {
            console.error('Modal not found.');
        }
    }
</script>
