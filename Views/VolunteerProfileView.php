<?php
require_once '../Controllers/VolunteerController.php';

$controller = new VolunteerController();
// assuming that the controller has a method to get the volunteer id from the session
$dummy_id = 49;
$volunteer = $controller->getVolunteerbyId($dummy_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile UI</title>
    <link rel="stylesheet" href="./Style/Style_volunteer_profile.css">
</head>
<body>
    <div class="container">
        <!-- Profile Section -->
        <div class="section">
            <h1>Volunteer Profile</h1>
            <form action= "VolunteerProfileView.php" method="POST">
            <input type="hidden" name="action" value="editProfileData">

            <!-- add hidden input for the volunteer id -->
            <input type="hidden" name="VolunteerID" value="<?php echo $volunteer->getVolunteerID(); ?>">
            <input type="hidden" name="UserID" value="<?php echo $volunteer->getUserID(); ?>">
                <div class="form-row">
                    <div>
                        <label for="FirstName">First Name</label>
                        <input type="text" id="FirstName" name="FirstName" value = "<?php echo $volunteer->getFirstName(); ?>" required>
                    </div>
                    <div>
                        <label for="LastName">Last Name</label>
                        <input type="text" id="LastName" name="LastName" required value = "<?php echo $volunteer->getLastName(); ?>">
                    </div>
                </div>
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" value="<?php echo $volunteer->getEmail(); ?>" required>

                <label for="PhoneNumber">Phone Number</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" value="<?php echo $volunteer->getPhoneNumber(); ?>" required>

                <label for="DateOfBirth">Date of Birth</label>
                <input type="date" id="DateOfBirth" name="DateOfBirth" value="<?php echo $volunteer->getDateOfBirth(); ?>" required>

                <label for="USER_NAME">User Name</label>
                <input type="text" id="USER_NAME" name="USER_NAME" value="<?php echo $volunteer->getUSER_NAME(); ?>" required>

                <label>Hours Contributed:</label>
                <input type="number" name="hours_contributed" value="<?php echo $volunteer->get_hours_contributed(); ?>" required>
                <label>Number of Events Attended:</label>
                <input type="number" name="NumberOfEventsAttended" value="<?php echo $volunteer->get_NumberOfEventsAttended(); ?>" required>
                <label>Badge:</label>
                <input type="text" name="badge" value ="<?php echo $volunteer->get_volunteer_badge(); ?>" readonly>


                <button type="submit">Save Profile</button>
                </form>


                <form action="VolunteerProfileView.php" method="POST">
                <input type="hidden" name="action" value="addLocation">
                <input type="hidden" name="UserID" value="<?php echo $volunteer->getUserID(); ?>">
                <input type="hidden" name="VolunteerID" value="<?php echo $volunteer->getVolunteerID(); ?>">
                
                <div class="locations-wrapper">
                <?php if (!empty($volunteer->getLocations($volunteer->UserID))): ?>
                    <?php foreach ($volunteer->getLocations($volunteer->UserID) as $index => $location): ?>
                        <div class="location-box">

                        <button type="button" style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline;" onclick="deleteLocation(<?= $location['ID']; ?>, <?= $volunteer->getUserID(); ?>)">Delete</button>

                            <p><strong>Country:</strong> <?php echo htmlspecialchars($location['Country']); ?></p>
                            <p><strong>City:</strong> <?php echo htmlspecialchars($location['City']); ?></p>
                            <p><strong>Area:</strong> <?php echo htmlspecialchars($location['Area']); ?></p>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No locations added yet.</p>
                    <?php endif; ?>
                </div>
                <!-- Add location button -->
                 <div id="additional-locations"></div>
                <button type="button" onclick="addLocation()">Add Location</button>
                
                <button type="submit">Save Locations</button>
                
            </form>
                            

                

               
        </div>

        <!-- Emergency Contacts Section -->
        <div class="section">
    <h2>Emergency Contacts</h2>
    <form id="emergencyContactForm" action="VolunteerProfileView.php" method="POST" 
      onsubmit="console.log('Form submitted'); return true;">
    <input type="hidden" name="action" value="addEmergencyContact">
    <input type="hidden" name="VolunteerID" value="<?php echo $volunteer->getVolunteerID(); ?>">
    <div class="form-row">
        <div>
            <label for="ContactName">Contact Name</label>
            <input type="text" id="ContactName" name="ContactName" required>
        </div>
        <div>
            <label for="ContactPhone">Contact Phone</label>
            <input type="text" id="ContactPhone" name="ContactPhone" required>
        </div>
    </div>
    <button type="submit">Add Emergency Contact</button>
</form>


    <div id="contactList">
        <h3>Saved Contacts</h3>
        <div id="contactsContainer" class="contact-cards">
            <!-- Pre-populated dummy contacts -->

            <?php foreach ($volunteer->getEmergencyContacts() as $contact): ?>
                <div class="contact-card">
                    <h4><?= htmlspecialchars($contact->getName()); ?></h4>
                    <p>Phone: <?= htmlspecialchars($contact->getPhoneNumber()); ?></p>
                    <button onclick="deleteContact(<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>, <?= $volunteer->getVolunteerID(); ?>)">Remove</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<div class="volunteer-section">
    <h2>Volunteer History</h2>
    <form id="volunteerForm">
        <div class="form-row">
            <div>
                <label for="volunteerOrganization">Organization</label>
                <input type="text" id="volunteerOrganization" name="volunteerOrganization" required>
            </div>
            <div>
                <label for="volunteerRole">Role</label>
                <input type="text" id="volunteerRole" name="volunteerRole" required>
            </div>
            <div>
                <label for="volunteerDate">Date</label>
                <input type="date" id="volunteerDate" name="volunteerDate" required>
            </div>
        </div>
        <button type="submit">Add Volunteer Experience</button>
    </form>

    <div id="volunteerList">
        <h3>Volunteer History</h3>
        <div id="volunteerContainer" class="volunteer-cards">
            <!-- Pre-populated dummy volunteer experiences -->
            <div class="volunteer-card">
                <h4>Red Cross</h4>
                <p>Role: Volunteer</p>
                <p>Date: 2023-07-15</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            </div>
            <div class="volunteer-card">
                <h4>Animal Shelter</h4>
                <p>Role: Caregiver</p>
                <p>Date: 2022-10-20</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            </div>
        </div>
    </div>
</div>

        <!-- Notification Settings Section -->
                     <div class="section">
                <h2>Notification Settings</h2>
                <form>
                    <label>Select Notification Types</label>
                    <div>
                        <input type="checkbox" id="email" name="notificationTypes" value="email">
                        <label for="email">Email</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sms" name="notificationTypes" value="sms">
                        <label for="sms">SMS</label>
                    </div>
                    <div>
                        <input type="checkbox" id="push" name="notificationTypes" value="push">
                        <label for="push">Push Notification</label>
                    </div>
                    <button type="submit">Save Notification Settings</button>
                </form>
            </div>

        <!-- Skills Section -->
        <div class="section">
    <h2>Skills</h2>
    <form id="skillsForm">
        <div class="form-row">
            <div>
                <label for="skill">Skill</label>
                <input type="text" id="skill" name="skill" required>
            </div>
            <div>
                <label for="proficiency">Proficiency (1-5)</label>
                <input type="number" id="proficiency" name="proficiency" min="1" max="5" required>
            </div>
        </div>
        <button type="submit">Add Skill</button>
    </form>

    <div id="skillList">
        <h3>Saved Skills</h3>
        <div id="skillsContainer" class="skill-cards">
            <!-- Pre-populated dummy skills -->
            <div class="skill-card">
                <h4>Python</h4>
                <p>Proficiency: 5</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            </div>
            <div class="skill-card">
                <h4>HTML/CSS</h4>
                <p>Proficiency: 4</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            </div>
            <div class="skill-card">
                <h4>JavaScript</h4>
                <p>Proficiency: 3</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            </div>
        </div>
    </div>
</div>

        <!-- Privileges Section -->
        <div class="section">
    <h2>Privileges</h2>
    <label>Privileges</label>
    <ul>
        <li>Admin</li>
        <li>Editor</li>
        <li>Viewer</li>
    </ul>
</div>

    </div>
</body>
</html>
<script>
    function deleteContact(contactID, volunteerID) {
        console.log('Deleting contact...');
    if (confirm('Are you sure you want to delete this contact?')) {
        // Prepare the data to send
        const formData = new FormData();
        formData.append('action', 'deleteContact');
        formData.append('ContactID', contactID);
        formData.append('VolunteerID', volunteerID);
    
        // Send the POST request using fetch
        fetch('VolunteerProfileView.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // You can handle the response as needed
        .then(data => {
            // Handle success response (optional)
            console.log(data);  
            window.location.reload();
        })
        .catch(error => {
            // Handle error response
            console.error('Error:', error);
        });

    }
}

    function deleteLocation(locationID, userID) {
        console.log('Deleting location...');
    if (confirm('Are you sure you want to delete this location?')) {
      // Prepare the data to send
      const formData = new FormData();
      formData.append('action', 'deleteLocation');
      formData.append('LocationID', locationID);
      formData.append('UserID', userID);

      // Send the POST request using fetch
      fetch('VolunteerProfileView.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())  // You can handle the response as needed
      .then(data => {
        // Handle success response (optional)
        console.log(data);  // You could show a message, refresh the page, etc.
        // refresh the page
        // location.reload();
      })
      .catch(error => {
        // Handle error response
        console.error('Error:', error);
      });
    }
  }
  document.getElementById('emergencyContactForm').addEventListener('submit', function (event) {
    const contactName = document.getElementById('ContactName').value;
    const contactPhone = document.getElementById('ContactPhone').value;

    if (!contactName || !contactPhone) {
        // Prevent submission if required fields are empty
        alert('Please fill out all fields.');
        event.preventDefault();
    } else {
        // Allow the form to submit normally
        console.log('Form submitted with values:', { contactName, contactPhone });
    }
});

    document.getElementById('skillsForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        const skillName = document.getElementById('skill').value;
        const skillProficiency = document.getElementById('proficiency').value;

        if (skillName && skillProficiency) {
            // Create a new skill card
            const skillCard = document.createElement('div');
            skillCard.classList.add('skill-card');

            // Add skill details to the card
            skillCard.innerHTML = `
                <h4>${skillName}</h4>
                <p>Proficiency: ${skillProficiency}</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            `;

            // Append the card to the container
            document.getElementById('skillsContainer').appendChild(skillCard);

            // Clear input fields
            document.getElementById('skill').value = '';
            document.getElementById('proficiency').value = '';
        }
    });
    document.getElementById('volunteerForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        const organization = document.getElementById('volunteerOrganization').value;
        const role = document.getElementById('volunteerRole').value;
        const date = document.getElementById('volunteerDate').value;

        if (organization && role && date) {
            // Create a new volunteer card
            const volunteerCard = document.createElement('div');
            volunteerCard.classList.add('volunteer-card');

            // Add volunteer details to the card
            volunteerCard.innerHTML = `
                <h4>${organization}</h4>
                <p>Role: ${role}</p>
                <p>Date: ${date}</p>
                <button onclick="this.parentElement.remove()">Remove</button>
            `;

            // Append the card to the container
            document.getElementById('volunteerContainer').appendChild(volunteerCard);

            // Clear input fields
            document.getElementById('volunteerOrganization').value = '';
            document.getElementById('volunteerRole').value = '';
            document.getElementById('volunteerDate').value = '';
        }
    });
    function addLocation() {
    console.log('Adding location...');
    // Create a new location box
    const newLocation = document.createElement('div');
    newLocation.classList.add('location-box');
    newLocation.innerHTML = `
        <p><strong>Country:</strong> <input type="text" name="Country[]" required></p>
        <p><strong>City:</strong> <input type="text" name="City[]" required></p>
        <p><strong>Area:</strong> <input type="text" name="Area[]" required></p>
    `;

    // Append the new location box to the "additional-locations" div
    document.getElementById('additional-locations').appendChild(newLocation);
}


</script>
