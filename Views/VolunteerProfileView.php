<?php
require_once '../Controllers/VolunteerController.php';


$controller = new VolunteerController();
// assuming that the controller has a method to get the volunteer id from the session
$dummy_id = 49;
$volunteer = $controller->getVolunteerbyId($dummy_id);
$allSkillTypes = $controller->getAllSkillTypes(); // This function fetches all skill types

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
                <div>
                <label for="badge">Badge Name</label>
                <input type="text" name="badge" value="<?php echo $volunteer->get_volunteer_badge()->get_title(); ?>" readonly>
            </div>
            <div>
                <label for="badgeScore">Badge Score</label>
                <input type="text" name="badgeScore" value="<?php echo $volunteer->get_volunteer_badge()->calc_score(); ?>" readonly>
            </div>


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
    <form id="emergencyContactForm">
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
    <button type="button" onclick="addEmergencyContact(
        document.getElementById('ContactName').value, 
        document.getElementById('ContactPhone').value, 
        <?= $volunteer->getVolunteerID(); ?>
    )">Add Emergency Contact</button>
</form>


<div id="contactList">
    <h3>Saved Contacts</h3>
    <div id="contactsContainer" class="contact-cards">
        <!-- Pre-populated dummy contacts -->
        <?php foreach ($volunteer->getEmergencyContacts() as $contact): ?>
            <div class="contact-card" id="contactCard<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>">
                <h4>
                    <span id="contactNameDisplay<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>">
                        <?= htmlspecialchars($contact->getName()); ?>
                    </span>
                    <input type="text" id="contactNameEdit<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>" value="<?= htmlspecialchars($contact->getName()); ?>" style="display: none;">
                </h4>
                <p>
                    <span id="contactPhoneDisplay<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>">
                        Phone: <?= htmlspecialchars($contact->getPhoneNumber()); ?>
                    </span>
                    <input type="text" id="contactPhoneEdit<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>" value="<?= htmlspecialchars($contact->getPhoneNumber()); ?>" style="display: none;">
                </p>
                <button onclick="deleteContact(<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>, <?= $volunteer->getVolunteerID(); ?>)">Remove</button>
                <button onclick="toggleEditModeforEmergencyContacts( <?= $volunteer->getVolunteerID(); ?>
                ,<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>, 
                '<?= $contact->getName(); ?>',
                '<?= $contact->getPhoneNumber(); ?>'
                )">Edit</button>

<button id="saveemergencycontact<?= $contact->getEmergencyContactID($contact->getName(), $contact->getPhoneNumber()); ?>" 
    style="display:none;" 
    onclick="update_emergency_contact()">
    Save
</button> 
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>


<div class="volunteer-section">
    <h2>Volunteer History</h2>
    <form id="volunteerForm" action="VolunteerProfileView.php" method="POST">
        <input type="hidden" name="action" value="addVolunteerHistory">
        <div class="form-row">
            <div>
                <label for="volunteerOrganization">Organization Name</label>
                <input type="text" id="volunteerOrganization" name="volunteerOrganization" required>
            </div>
            <div>
                <label for="volunteerStartDate">Start Date</label>
                <input type="date" id="volunteerStartDate" name="volunteerStartDate" required>
            </div>
            <div>
                <label for="volunteerEndDate">End Date</label>
                <input type="date" id="volunteerEndDate" name="volunteerEndDate" required>
            </div>
            <div>
                <label for="EventName">Event Name</label>
                <input type="text" id="EventName" name="EventName" required>
            </div>
            <div>
                <label for="EventDescription">Event Description</label>
                <input type="text" id="EventDescription" name="EventDescription" required>
            </div>
            <div>
                <label for="EventCountry">Coutry</label>
                <input type="text" id="EventCountry" name="EventCountry" required>
            </div>
            <div>
                <label for="EventCity">City</label>
                <input type="text" id="EventCity" name="EventCity" required>
            </div>
            <div>
                <label for="EventArea">Area</label>
                <input type="text" id="EventArea" name="EventArea" required>
            </div>
        </div>
        <button type="button" onclick="addVolunteerHistory(
        <?= $volunteer->getVolunteerID(); ?>,
        document.getElementById('volunteerOrganization').value,
        document.getElementById('volunteerStartDate').value,
        document.getElementById('volunteerEndDate').value,
        document.getElementById('EventName').value,
        document.getElementById('EventDescription').value,
        document.getElementById('EventCountry').value,
        document.getElementById('EventCity').value,
        document.getElementById('EventArea').value
    )">Add Volunteer History</button>
    </form>

    <div id="volunteerList">
    <h3>Volunteer History</h3>
    <div id="volunteerContainer" class="volunteer-cards">
        <?php foreach ($volunteer->get_volunteer_history() as $volunteerHistory): ?>
            <div class="volunteer-card" id="card<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                <h4>
                    <strong>Organization Name:</strong>
                    <span id="organizationNameDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->get_organization_name()); ?>
                    </span>
                    <input type="text" id="organizationNameEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="organizationName" value="<?= htmlspecialchars($volunteerHistory->get_event()->get_organization_name()); ?>" style="display:none;">
                </h4>
                <p>
                    <strong>Start Date:</strong>
                    <span id="startDateDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->getStartDate()); ?>
                    </span>
                    <input type="date" id="startDateEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="startDate" value="<?= htmlspecialchars($volunteerHistory->getStartDate()); ?>" style="display:none;">
                </p>
                <p>
                    <strong>End Date:</strong>
                    <span id="endDateDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->getEndDate()); ?>
                    </span>
                    <input type="date" id="endDateEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="endDate" value="<?= htmlspecialchars($volunteerHistory->getEndDate()); ?>" style="display:none;">
                </p>
                <p>
                    <strong>Event Name:</strong>
                    <span id="eventNameDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->getEventName()); ?>
                    </span>
                    <input type="text" id="eventNameEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="eventName" value="<?= htmlspecialchars($volunteerHistory->get_event()->getEventName()); ?>" style="display:none;">
                </p>
                <p>
                    <strong>Event Description:</strong>
                    <span id="eventDescriptionDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->getEventDescription()); ?>
                    </span>
                    <textarea id="eventDescriptionEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="eventDescription" style="display:none;"><?= htmlspecialchars($volunteerHistory->get_event()->getEventDescription()); ?></textarea>
                </p>
                <p>
                    <strong>Event Location:</strong>
                    <span id="eventLocationDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->getLocationDetails($volunteerHistory->get_event()->getEventID())); ?>
                    </span>
                    <input type="text" id="eventLocationEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="eventLocation" value="<?= htmlspecialchars($volunteerHistory->get_event()->getLocationDetails($volunteerHistory->get_event()->getEventID())); ?>" style="display:none;">
                </p>

                <button type="button" onclick="toggleEditMode(<?= $volunteerHistory->getVolunteerHistoryID(); ?>,  '<?= $volunteerHistory->get_event()->get_organization_name(); ?>', 
        '<?= $volunteerHistory->getStartDate(); ?>', 
        '<?= $volunteerHistory->getEndDate(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventName(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventDescription(); ?>', 
        '<?= $volunteerHistory->get_event()->getLocationDetails($volunteerHistory->get_event()->getEventID()); ?>')">Update</button>
                <button type="button" 
    id="saveButton<?= $volunteerHistory->getVolunteerHistoryID(); ?>" 
    style="display:none;" 
    onclick="saveChanges(
        '<?= $volunteerHistory->get_event()->get_organization_name(); ?>', 
        '<?= $volunteerHistory->getStartDate(); ?>', 
        '<?= $volunteerHistory->getEndDate(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventName(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventDescription(); ?>', 
        '<?= $volunteerHistory->get_event()->getLocationDetails($volunteerHistory->get_event()->getEventID()); ?>', 
        <?= $volunteerHistory->getVolunteerHistoryID(); ?>
    )">Save Changes</button>



                <button type="button" onclick="deleteVolunteerHistory(<?= $volunteerHistory->getVolunteerHistoryID(); ?>, <?= $volunteer->getVolunteerID(); ?>)">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</div>

        <!-- Notification Settings Section -->
        <div class="section">
    <h2>Notification Settings</h2>
    <form>
    <label>Select Notification Types</label>
    <?php 
    // Fetch all available notification types
    $notificationTypes = $controller->get_all_notification_types();
    // Fetch the notification types already selected by the user
    $userNotificationTypes = $controller->get_notification_types($volunteer->UserID); 

    // Loop through each notification type and create a checkbox for it
    foreach ($notificationTypes as $notificationType) {
        // Check if the user's notification type ID is in the list of selected types
        $isChecked = in_array($notificationType->NotificationTypeID, array_column($userNotificationTypes, 'NotificationTypeID')) ? 'checked' : '';
        echo '<div>';
        echo '<input type="checkbox" id="' . strtolower($notificationType->TypeName) . '" name="notificationTypes[]" value="' . $notificationType->TypeName . '" ' . $isChecked . '>';
        echo '<label for="' . strtolower($notificationType->TypeName) . '">' . $notificationType->TypeName . '</label>';
        echo '</div>';
    }
    ?>
    <button type="button" onclick="update_notification_settings()">Save Notification Settings</button>
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
            <label for="SkillLevel">Skill Level (1-5)</label>
            <input type="number" id="SkillLevel" name="SkillLevel" min="1" max="5" required>
        </div>
        <div>
            <label>Skill Types:</label>
            <div id="SkillTypes">
    <?php foreach ($allSkillTypes as $skillType): ?>
        <div class="skill-type">
            <label for="skillType<?= htmlspecialchars($skillType->SkillTypeID); ?>">
                <?= htmlspecialchars($skillType->SkillTypeName); ?>
            </label>
            <input type="checkbox" 
                   id="skillType<?= htmlspecialchars($skillType->SkillTypeID); ?>" 
                   name="skillTypes[]" 
                   value="<?= htmlspecialchars($skillType->SkillTypeID); ?>">
        </div>
    <?php endforeach; ?>
</div>

        </div>
    </div>
    <button type="button" 
            onclick="addSkill(
                <?= $volunteer->getVolunteerID(); ?>,
                document.getElementById('skill').value, 
                document.getElementById('SkillLevel').value, 
                getCheckedSkillTypes()
            )">
        Add Skill
    </button>
</form>

    <div id="skillList">
        <h3>Saved Skills</h3>
        <div id="skillsContainer" class="skill-cards">
            <!-- Pre-populated dummy skills -->
            <?php foreach ($volunteer->get_skills() as $skill): ?>
                <div class="skill-card">
                    <h4><?= htmlspecialchars($skill->SkillName); ?></h4>
                    <p>Proficiency: <?= htmlspecialchars($skill->SkillLevel); ?></p>
                    <p> Skill Types: <?= htmlspecialchars(implode(', ', array_map(fn($skillType) => $skillType->SkillTypeName, $skill->get_skill_types()))); ?> </p>
                    <button onclick= "remove_skill(<?= $skill->SkillID; ?>, <?= $volunteer->getVolunteerID(); ?>)">Remove</button>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

        <!-- Privileges Section -->
        <div class="section">
    <h2>Privileges</h2>
    <label>Privileges</label>
    <ul>
        <?php foreach ($volunteer->getPrivileges() as $privilege): ?>
            <li><?= htmlspecialchars($privilege->PrivilegeName); ?></li>   
        <?php endforeach; ?>
    </ul>
</div>

    </div>
</body>
</html>
<script>


    function addEmergencyContact($Name, $Phone, $VolunteerID) {
        console.log('Adding emergency contact...');
        console.log('Name:', $Name);
        console.log('Phone:', $Phone);
        console.log('VolunteerID:', $VolunteerID);

        const formData = new FormData();
        formData.append('action', 'addEmergencyContact');
        formData.append('ContactName', $Name);
        formData.append('ContactPhone', $Phone);
        formData.append('VolunteerID', $VolunteerID);

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


      function toggleEditMode(id, organizationName, startDate, endDate, eventName, eventDescription, eventLocation) {
    const displayFields = document.querySelectorAll(`#card${id} span`);
    const editFields = document.querySelectorAll(`#card${id} input, #card${id} textarea`);
    const saveButton = document.getElementById(`saveButton${id}`);
    
    let updatedValues = {};
    
    displayFields.forEach(field => {
    if (!field.id.includes('Location')) { // Skip fields with 'Location' in their ID
        field.style.display = field.style.display === 'none' ? '' : 'none';
    }
});

    // displayFields.forEach(field => field.style.display = field.style.display === 'none' ? '' : 'none');
    
    editFields.forEach(field => {
        // Set up event listener for each editable field
        field.addEventListener('input', (e) => {
            updatedValues[field.id] = e.target.value;  // Update the value dynamically
            console.log(updatedValues); // Debugging to log the updated values
            console.log(field.id);
            saveButton.setAttribute('onclick', `saveChanges(
        "${updatedValues['organizationNameEdit' + id] || organizationName}",
        "${updatedValues['startDateEdit' + id] || startDate}",
        "${updatedValues['endDateEdit' + id] || endDate}",
        "${updatedValues['eventNameEdit' + id] || eventName}",
        "${updatedValues['eventDescriptionEdit' + id] || eventDescription}",
        "${updatedValues['eventLocationEdit' + id] || eventLocation}",
        ${id}
    )`);
        });

        field.style.display = field.id.includes('Location') ? field.style.display : (field.style.display === 'none' ? '' : 'none');

    });

    // make the save button visible
    saveButton.style.display = saveButton.style.display === 'none' ? '' : 'none';
   
}
function toggleEditModeforEmergencyContacts(volunteerID, id, ContactName, ContactPhone) {
    console.log('Toggling edit mode for emergency contacts...');
    const displayFields = document.querySelectorAll(`#contactCard${id} span`);
    const editFields = document.querySelectorAll(`#contactCard${id} input`);
    const saveButton = document.getElementById(`saveemergencycontact${id}`); // Unique save button for this contact
    console.log("displayFields", displayFields);
    console.log("editFields", editFields);
    console.log("saveButton", saveButton);

    let updatedValues = {};

    // Toggle the display of display fields and edit fields
    displayFields.forEach(field => {
        field.style.display = field.style.display === 'none' ? '' : 'none';
    });

    editFields.forEach(field => {
        console.log("field is", field);
        // Add event listener for each editable field to update the values dynamically
        field.addEventListener('input', (e) => {
            updatedValues[field.id] = e.target.value;  // Update the value dynamically
            console.log(updatedValues); // Debugging to log the updated values

            // Update the save button's onclick with the updated values
            saveButton.setAttribute('onclick', `update_emergency_contact(
                ${volunteerID},
                "${updatedValues['contactNameEdit' + id] || ContactName}",
                "${updatedValues['contactPhoneEdit' + id] || ContactPhone}",
                ${id}
            )`);
        });

        field.style.display = field.style.display === 'none' ? '' : 'none';
    });

    // Toggle the save button's visibility
    if (saveButton) {
        saveButton.style.display = saveButton.style.display === 'none' ? '' : 'block';
    }
}




function update_emergency_contact($VolunteerID, $Name, $Phone, $ContactID) {
    console.log('Updating emergency contact...');
    console.log($Name, $Phone, $ContactID);
    // Get the updated values
    console.log($Name, $Phone, $ContactID);
    formData = new FormData();
    formData.append('action', 'updateEmergencyContact');
    formData.append('VolunteerID', $VolunteerID);
    formData.append('ContactID', $ContactID);
    formData.append('Name', $Name);
    formData.append('Phone', $Phone);

    // Send the updated values to the server
    fetch('VolunteerProfileView.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // You can handle the response as needed
    .then(data => {
        // Handle success response (optional)
        console.log(data);  // You could show a message, refresh the page, etc.
    })
    .catch(error => {
        // Handle error response
        console.error('Error:', error);
    });
}
{

    
}

function update_notification_settings() {
    console.log('Updating notification settings...');
    // Get the checked checkboxes
    const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked');
    const notificationTypes = Array.from(checkedBoxes).map(box => box.value);
    console.log('Selected notification types:', notificationTypes);

    // Convert the array to a comma-separated string
    const notificationTypesString = notificationTypes.join(',');
    formData = new FormData();
    formData.append('action', 'updateNotificationSettings');
    formData.append('UserID', <?= $volunteer->getUserID(); ?>);
    formData.append('notificationTypes', notificationTypesString);

    // Send the comma-separated string to the server
    fetch('VolunteerProfileView.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())  // You can handle the response as needed
    .then(data => {
        // Handle success response (optional)
        console.log(data);  // You could show a message, refresh the page, etc.
    })
    .catch(error => {
        // Handle error response
        console.error('Error:', error);
    });
}


function remove_skill(skillID, VolunteerID) {
    console.log('Removing skill...');
    if (confirm('Are you sure you want to remove this skill?')) {
        const formData = new FormData();
        formData.append('action', 'deleteSkill');
        formData.append('SkillID', skillID);
        formData.append('VolunteerID', VolunteerID);
    
        // Send the POST request using fetch
        fetch('VolunteerProfileView.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // You can handle the response as needed
        .then(data => {
            // Handle success response (optional)
            console.log(data);  
            // window.location.reload();
        })
        .catch(error => {
            // Handle error response
            console.error('Error:', error);
        });

    }
}

function getCheckedSkillTypes() {
    const checkedBoxes = document.querySelectorAll('#SkillTypes input[type="checkbox"]:checked');
    return Array.from(checkedBoxes).map(box => {
        // Get the label by matching the 'for' attribute of the label with the id of the checkbox
        const label = document.querySelector(`label[for="${box.id}"]`);
        console.log("label is", label.textContent);

        return label.textContent.trim() ;  // Return the label text
    });
}


    function addSkill($VolunteerID, $skillName, $skillLevel, $skillTypes) {
    console.log('Adding skill...');
        formData = new FormData();
        formData.append('action', 'addSkill');
        formData.append('VolunteerID', $VolunteerID);
        formData.append('SkillName', $skillName);
        formData.append('SkillLevel', $skillLevel);
        formData.append('SkillTypes', $skillTypes);

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
    }

    function saveChanges(OrganizationName, StartDate, EndDate, EventName, EventDescription, EventLocation, VolunteerHistoryID) {
        console.log('Saving changes...');


        console.log("Values to Save: ", OrganizationName, StartDate, EndDate, EventName, EventDescription, EventLocation, VolunteerHistoryID);
        formData = new FormData();
        formData.append('action', 'editVolunteerHistory');
        formData.append('VolunteerHistoryID', VolunteerHistoryID);
        formData.append('OrganizationName', OrganizationName);
        formData.append('StartDate', StartDate);
        formData.append('EndDate', EndDate);
        formData.append('EventName', EventName);
        formData.append('EventDescription', EventDescription);
        formData.append('EventLocation', EventLocation);


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


  

    function deleteVolunteerHistory(volunteerHistoryID, volunteerID) {
        console.log('Deleting volunteer history...');
    if (confirm('Are you sure you want to delete this volunteer history?')) {
        // Prepare the data to send
        const formData = new FormData();
        formData.append('action', 'deleteVolunteerHistory');
        formData.append('VolunteerHistoryID', volunteerHistoryID);
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

    function addVolunteerHistory(VolunteerID, organization, startDate, endDate, eventName, eventDescription, eventCountry, eventCity, eventArea) {
        console.log('Adding volunteer history...');
        console.log('VolunteerID:', VolunteerID);


        const formData = new FormData();
        formData.append('action', 'addVolunteerHistory');
        formData.append('volunteerOrganization', organization);
        formData.append('volunteerStartDate', startDate);
        formData.append('volunteerEndDate', endDate);
        formData.append('EventName', eventName);
        formData.append('EventDescription', eventDescription);
        formData.append('EventCountry', eventCountry);
        formData.append('EventCity', eventCity);
        formData.append('EventArea', eventArea);
        formData.append('VolunteerID', VolunteerID);


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
            // window.location.reload();
        })

        .catch(error => {
            // Handle error response
            console.error('Error:', error);
        });


    }

    function deleteContact(contactID, volunteerID) {
        console.log('Deleting contact...');
        console.log('ContactID:', contactID);

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
            // window.location.reload();
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
