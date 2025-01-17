<?php
require_once '../Controllers/VolunteerController.php';
require_once '../Controllers/EventController.php';
require_once '../Models/BadgeFactory.php';


$apiUrl = "https://www.universal-tutorial.com/api/countries/";
$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiIyMHA2MDIyQGVuZy5hc3UuZWR1LmVnIiwiYXBpX3Rva2VuIjoiWlpGVXZWdlV4WlVEVWd2SWdINVZOSGNOVXY5STdHa2NUTWhoVndaQkp0TExiUVBYS0xIcG9LckRRejExM1BmSnJrRSJ9LCJleHAiOjE3MzcwMDIxMDh9.psK5D96hgISDXgRSUEgRB6KoaukwkqmfOhsXp8acCPQ"; // Replace with your actual token


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $apiUrl);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     "Authorization: Bearer $token",
//     "Accept: application/json"
// ]);

// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable peer verification
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Disable host verification

// // Enable cURL debugging
// // curl_setopt($ch, CURLOPT_VERBOSE, true);
// $response = curl_exec($ch);

// // Check for cURL errors
// if(curl_errno($ch)) {
//     echo 'cURL Error: ' . curl_error($ch);
//     exit;
// }

// // Get the HTTP status code
// $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// echo "HTTP Status Code: $http_code";

// // Close the cURL resource
// curl_close($ch);

// if ($response === false) {
//     echo "Error fetching countries in view.";
//     exit;
// }
// $countries = json_decode($response, true); // Decode JSON response

// // Check if countries data was retrieved
// if (!$countries) {
//     echo "Error: Invalid JSON response.";
//     exit;
// }

// $countryNames = array_map(function($country) {
//     return $country['country_name']; // Extracting only the country name
// }, $countries);

// // Remove duplicates from the country names array
// $countryNames = array_unique($countryNames);



$controller = new VolunteerController();
$controller2 = new EventController();

// Retrieve all events
$events = $controller2->getAllEvents();





// $controller->insertCountriesIntoDB($countryNames);
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

<div id="mySidebar" class="sidebar">
    <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
    <!-- display a list of all notifications by calling controller->getVolunteerNotifications -->
    <h2>Notifications</h2>
    <div class="notifications">
        <?php foreach ($controller->getVolunteerNotifications($volunteer->getUserID()) as $notification): ?>
            <div class="notification-card">
                <div class="notification-card-header">
                    <strong>Notification</strong>
                </div>
                <div class="notification-card-body">
                    <p><?= $notification->get_Message(); ?></p>
                </div>
                <div class="notification-card-footer">
                    <small><?= $notification->getNotificationTime(); ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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
</script>
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
    <input type="hidden" name="UserID" value="<?php echo $volunteer->getUserID(); ?>">
    <input type="hidden" name="VolunteerID" value="<?php echo $volunteer->getVolunteerID(); ?>">

    <!-- Location Selectors (if applicable) -->
    <select class="country-dropdown" name="locations[<?php echo $locationIndex; ?>][country]" onchange="handleCountryChange(this, this.nextElementSibling, this.nextElementSibling.nextElementSibling)">
        <option value="">Select Country</option>
    </select>
    <select class="city-dropdown" name="locations[<?php echo $locationIndex; ?>][city]" onchange="handleCityChange(this, this.nextElementSibling)">
        <option value="">Select City</option>
    </select>
    <select class="area-dropdown" name="locations[<?php echo $locationIndex; ?>][area]">
        <option value="">Select Area</option>
    </select>

    <div class="locations-wrapper">
        <?php if (!empty($volunteer->getLocations($volunteer->UserID))): ?>
            <?php foreach ($volunteer->getLocations($volunteer->UserID) as $index => $location): ?>
                <div class="location-box" id="location-<?= $location['ID']; ?>">
                    <button type="button" style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline;" 
                            onclick="deleteLocation(<?= $location['ID']; ?>, <?= $volunteer->getUserID(); ?>)">Delete</button>
                    <p id="country-display-<?= $location['ID']; ?>"><strong>Country:</strong> <?php echo htmlspecialchars($location['Country']); ?></p>
                    <p id="city-display-<?= $location['ID']; ?>"><strong>City:</strong> <?php echo htmlspecialchars($location['City']); ?></p>
                    <p id="area-display-<?= $location['ID']; ?>"><strong>Area:</strong> <?php echo htmlspecialchars($location['Area']); ?></p>

                    <!-- Hidden editable dropdowns -->
                    <select id="country-edit-<?= $location['ID']; ?>" class="country-dropdown" style="display:none;" onchange="handleCountryChange(this, this.nextElementSibling, this.nextElementSibling.nextElementSibling)">
                        <option value="">Select Country</option>
                        <option value="Country1" <?= $location['Country'] === 'Country1' ? 'selected' : ''; ?>>Country1</option>
                        <option value="Country2" <?= $location['Country'] === 'Country2' ? 'selected' : ''; ?>>Country2</option>
                    </select>
                    <select id="city-edit-<?= $location['ID']; ?>" class="city-dropdown" style="display:none;" onchange="handleCityChange(this, this.nextElementSibling)">
                        <option value="">Select City</option>
                        <option value="City1" <?= $location['City'] === 'City1' ? 'selected' : ''; ?>>City1</option>
                        <option value="City2" <?= $location['City'] === 'City2' ? 'selected' : ''; ?>>City2</option>
                    </select>
                    <select id="area-edit-<?= $location['ID']; ?>" class="area-dropdown" style="display:none;">
                        <option value="">Select Area</option>
                        <option value="Area1" <?= $location['Area'] === 'Area1' ? 'selected' : ''; ?>>Area1</option>
                        <option value="Area2" <?= $location['Area'] === 'Area2' ? 'selected' : ''; ?>>Area2</option>
                    </select>

                    <!-- Edit buttons -->
                    <button type="button" onclick="toggleeditModeforLocations(<?= $volunteer->getUserID(); ?>, <?= $volunteer->getVolunteerID(); ?>, <?= $location['ID']; ?>, '<?= addslashes($location['Country']); ?>', '<?= addslashes($location['City']); ?>', '<?= addslashes($location['Area']); ?>')">Edit</button>
                    <button type="button" onclick="saveLocations(<?= $location['ID']; ?>, <?= $volunteer->getUserID(); ?>, <?= $volunteer->getVolunteerID(); ?>, document.querySelectorAll('.area-dropdown'), document.querySelectorAll('.city-dropdown'), document.querySelectorAll('.country-dropdown'))">Save Locations</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Button for adding location if no locations are present -->
            <!-- <button type="button" onclick="saveLocations(null, <?= $volunteer->getUserID(); ?>, <?= $volunteer->getVolunteerID(); ?>, document.querySelectorAll('.area-dropdown'), document.querySelectorAll('.city-dropdown'), document.querySelectorAll('.country-dropdown'))">Add Location</button> -->
        <?php endif; ?>
        <button type="button" onclick="saveLocations(null, <?= $volunteer->getUserID(); ?>, <?= $volunteer->getVolunteerID(); ?>, document.querySelectorAll('.area-dropdown'), document.querySelectorAll('.city-dropdown'), document.querySelectorAll('.country-dropdown'))">Add Location</button>

    </div>
</form>

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
</div>


<div id="contactList">
    <h3>Saved Contacts</h3>
    <div id="contactsContainer" class="contact-cards">
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
            
            <!-- make the organization name to be from a drop down box that will display the organizations that the user has worked with -->

                

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
            <!-- make them a drop down boxees like above -->
            <div>
            <label for="volunteerOrganization">Organization Name</label>
            <select id="volunteerOrganization" name="volunteerOrganization" required>
                <option value="" disabled selected>Select an organization</option>
                <?php
                $organizationNames = $controller->getallorganizationNames(); 

                foreach ($organizationNames as $orgName) {
                    echo "<option value=\"" . htmlspecialchars($orgName) . "\">" . htmlspecialchars($orgName) . "</option>";
                }
                ?>
            </select>
        </div>

             <div>
                <label for="EventLocation">Event Location</label>
         <!--   <select class="country-dropdown" name="locations[<?php echo $locationIndex; ?>][country]" onchange="handleCountryChange(this, this.nextElementSibling, this.nextElementSibling.nextElementSibling)"> -->
        <option value="">Select Country</option>
    </select>
    <select class="city-dropdown" name="locations[<?php echo $locationIndex; ?>][city]" onchange="handleCityChange(this, this.nextElementSibling)">
        <option value="">Select City</option>
    </select>
    <select class="area-dropdown" name="locations[<?php echo $locationIndex; ?>][area]">
        <option value="">Select Area</option>
    </select>
             </div>
        </div>
        <button type="button" onclick="addVolunteerHistory(
        <?= $volunteer->getVolunteerID(); ?>,
        document.getElementById('volunteerOrganization').value,
        document.getElementById('volunteerStartDate').value,
        document.getElementById('volunteerEndDate').value,
        document.getElementById('EventName').value,
        document.getElementById('EventDescription').value,
        document.querySelectorAll('.country-dropdown'),
        document.querySelectorAll('.city-dropdown'),
        document.querySelectorAll('.area-dropdown')
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
                <br>
                
                    <strong>Start Date:</strong>
                    <span id="startDateDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->getStartDate()); ?>
                    </span>
                    <input type="date" id="startDateEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="startDate" value="<?= htmlspecialchars($volunteerHistory->getStartDate()); ?>" style="display:none;">
                    <br>
                    <strong>End Date:</strong>
                    <span id="endDateDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->getEndDate()); ?>
                    </span>
                    <input type="date" id="endDateEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="endDate" value="<?= htmlspecialchars($volunteerHistory->getEndDate()); ?>" style="display:none;">
                    <br>
                
                    <strong>Event Name:</strong>
                    <span id="eventNameDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->getEventName()); ?>
                    </span>
                    <input type="text" id="eventNameEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="eventName" value="<?= htmlspecialchars($volunteerHistory->get_event()->getEventName()); ?>" style="display:none;">
                    <br>
                    <strong>Event Description:</strong>
                    <span id="eventDescriptionDisplay<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <?= htmlspecialchars($volunteerHistory->get_event()->getEventDescription()); ?>
                    </span>
                    <textarea id="eventDescriptionEdit<?= $volunteerHistory->getVolunteerHistoryID(); ?>" name="eventDescription" style="display:none;"><?= htmlspecialchars($volunteerHistory->get_event()->getEventDescription()); ?></textarea>
                    <br>
                    <strong>Event Location:</strong>
                    <!-- Country -->
                    <p id="country-display-<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                    <?php $areaName = $volunteerHistory->get_event()->get_location()->Name; ?>
                        <?php $cityName = $volunteerHistory->get_event()->get_location()->getParentFromChild($areaName); ?>
                        <?php $countryName = $volunteerHistory->get_event()->get_location()->getParentFromChild($cityName); ?>
                        <strong>Country:</strong> <?= htmlspecialchars($volunteerHistory->get_event()->get_location()->getParentFromChild($cityName)); ?>
                    <p id="city-display-<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <strong>City:</strong> <?= htmlspecialchars($volunteerHistory->get_event()->get_location()->getParentFromChild($areaName)); ?>
                    </p>

                    
                    <!-- Area -->
                    <p id="area-display-<?= $volunteerHistory->getVolunteerHistoryID(); ?>">
                        <strong>Area:</strong> <?= htmlspecialchars($areaName); ?>
                    </p>
               
                <!-- hidden editable  -->
                    <select id="country-edit-<?= $location['ID']; ?>" class="country-dropdown" style="display:none;" onchange="handleCountryChange(this, this.nextElementSibling, this.nextElementSibling.nextElementSibling)">
                        <option value="">Select Country</option>
                        <option value="Country1" <?= $location['Country'] === 'Country1' ? 'selected' : ''; ?>>Country1</option>
                        <option value="Country2" <?= $location['Country'] === 'Country2' ? 'selected' : ''; ?>>Country2</option>
                    </select>
                    <select id="city-edit-<?= $location['ID']; ?>" class="city-dropdown" style="display:none;" onchange="handleCityChange(this, this.nextElementSibling)">
                        <option value="">Select City</option>
                        <option value="City1" <?= $location['City'] === 'City1' ? 'selected' : ''; ?>>City1</option>
                        <option value="City2" <?= $location['City'] === 'City2' ? 'selected' : ''; ?>>City2</option>
                    </select>
                    <select id="area-edit-<?= $location['ID']; ?>" class="area-dropdown" style="display:none;">
                        <option value="">Select Area</option>
                        <option value="Area1" <?= $location['Area'] === 'Area1' ? 'selected' : ''; ?>>Area1</option>
                        <option value="Area2" <?= $location['Area'] === 'Area2' ? 'selected' : ''; ?>>Area2</option>
                    </select>


                <button type="button" onclick="toggleEditMode(<?= $location['ID'];?>,
                <?= $volunteerHistory->getVolunteerHistoryID(); ?>,  '<?= $volunteerHistory->get_event()->get_organization_name(); ?>', 
        '<?= $volunteerHistory->getStartDate(); ?>', 
        '<?= $volunteerHistory->getEndDate(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventName(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventDescription(); ?>', 
        '<?= $areaName;?>',
        '<?= $cityName;?>',
        '<?= $countryName?>'
        )">Update</button>
                <button type="button" 
    id="saveButton<?= $volunteerHistory->getVolunteerHistoryID(); ?>" 
    style="display:none;" 
    onclick="saveChanges(
        '<?= $volunteerHistory->get_event()->get_organization_name(); ?>', 
        '<?= $volunteerHistory->getStartDate(); ?>', 
        '<?= $volunteerHistory->getEndDate(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventName(); ?>', 
        '<?= $volunteerHistory->get_event()->getEventDescription(); ?>', 
        document.querySelectorAll('.area-dropdown'), document.querySelectorAll('.city-dropdown'), 
        document.querySelectorAll('.country-dropdown')), 
        '<?= $volunteerHistory->getVolunteerHistoryID(); ?>')">Save Changes</button>



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
 

  
    <h2>Events</h2>
   
    <div class="event-container">
    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
        <div class="event-card">
            <h4><strong>Name:</strong> <?= htmlspecialchars($event->EventName); ?></h4>
            <p><strong>Date:</strong> <?= htmlspecialchars($event->EventDate); ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($event->EventDescription); ?></p>
            <button class="apply-button" onclick="applyForEvent(<?= htmlspecialchars($event->EventID); ?>)">
                Apply
            </button>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No events found.</p>
    <?php endif; ?>
</div>

<style>
/* Container styles */
.event-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Space between event cards */
    justify-content: center; /* Center the cards */
    padding: 20px;
}

/* Event card styles */
.event-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 15px;
    width: 250px; /* Fixed width for uniformity */
    text-align: center;
}

/* Button styles */
.apply-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 10px;
}

.apply-button:hover {
    background-color: #45a049;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .event-card {
        width: 100%; /* Full width on small screens */
    }
}
</style>


    </div>

    
</body>
</html>
<script>

function saveLocations(LocationID= null,UserID, volunteerID, areaDropdowns, cityDropdowns, countryDropdowns) {
    console.log("now saving locations");

    const locations = []; // To store the selected locations

    // Loop through all the dropdowns, assuming they are in corresponding order
    for (let i = 0; i < areaDropdowns.length; i++) {
        const areaDropdown = areaDropdowns[i];
        const cityDropdown = cityDropdowns[i];
        const countryDropdown = countryDropdowns[i];

        const selectedArea = areaDropdown.value;
        const selectedCity = cityDropdown.value;
        const selectedCountry = countryDropdown.value;

        // Check if all values are selected before adding to locations
        if (selectedArea && selectedCity && selectedCountry) {
            locations.push({
                area: selectedArea,
                city: selectedCity,
                country: selectedCountry,
            });
        }
    }

    // Prepare the data for the server
    const formData = new FormData();
    formData.append('action', 'addLocation');
    formData.append('VolunteerID', volunteerID);
    formData.append('UserID', UserID);
    formData.append('locations', JSON.stringify(locations)); // Convert to JSON string
    formData.append('LocationID', LocationID);

    // Send data to the server via fetch
    fetch('VolunteerProfileView.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            console.log('Locations saved:', data);
        })
        .catch(error => {
            console.error('Error saving locations:', error);
        });
}




    async function fetchAccessToken() {
    const url = "https://www.universal-tutorial.com/api/getaccesstoken";
    const headers = {
        "Accept": "application/json",
        "api-token": "ZZFUvVvUxZUDUgvIgH5VNHcNUv9I7GkcTMhhVwZBJtLLbQPXKLHpoKrDQz113PfJrkE", // Replace with your actual API token
        "user-email": "20p6022@eng.asu.edu.eg" // Replace with your actual email
    };
    

    try {
        const response = await fetch(url, {
            method: "GET",
            headers: headers
        });

        if (!response.ok) {
            throw new Error("Failed to fetch access token");
        }

        const data = await response.json();
        console.log("Access Token:", data.auth_token); // Assuming the token is returned as 'auth_token'
        return data.auth_token; // Return the token for further use
    } catch (error) {
        console.error("Error fetching access token:", error);
    }
}

fetchAccessToken();

async function fetchCountries() {
    try {
        const response = await fetch("https://www.universal-tutorial.com/api/countries/", {
            method: "GET",
            headers: {
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiIyMHA2MDIyQGVuZy5hc3UuZWR1LmVnIiwiYXBpX3Rva2VuIjoiWlpGVXZWdlV4WlVEVWd2SWdINVZOSGNOVXY5STdHa2NUTWhoVndaQkp0TExiUVBYS0xIcG9LckRRejExM1BmSnJrRSJ9LCJleHAiOjE3MzcwMDIxMDh9.psK5D96hgISDXgRSUEgRB6KoaukwkqmfOhsXp8acCPQ", // Replace with your actual token
                "Accept": "application/json"
            }
        });

        if (!response.ok) {
            throw new Error('Error fetching countries');
        }

        const countries = await response.json(); // Assuming API returns an array of countries
        const countryList = countries.map(country => country.country_name).sort();

        // Populate all country dropdowns
        document.querySelectorAll('.country-dropdown').forEach(dropdown => {
            dropdown.innerHTML = '<option value="">Select Country</option>';
            countryList.forEach(country => {
                const option = document.createElement('option');
                option.value = country;
                option.textContent = country;
                dropdown.appendChild(option);
            });
        });
    } catch (error) {
        console.error('Error fetching countries:', error);
        alert('Could not fetch countries. Please try again.');
    }
}

// Call this function to load countries when the page is ready
document.addEventListener('DOMContentLoaded', fetchCountries);



// Handle country change to fetch cities
// Handle country change to fetch states (cities in your naming convention)
async function handleCountryChange(countryDropdown, cityDropdown, areaDropdown) {
    const selectedCountry = countryDropdown.value; // Use country name (e.g., "United States")
    if (!selectedCountry) return;

    try {
        console.log('Fetching states (cities) for', selectedCountry);

        // Fetch states (cities) for the selected country
        const response = await fetch(`https://www.universal-tutorial.com/api/states/${selectedCountry}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiIyMHA2MDIyQGVuZy5hc3UuZWR1LmVnIiwiYXBpX3Rva2VuIjoiWlpGVXZWdlV4WlVEVWd2SWdINVZOSGNOVXY5STdHa2NUTWhoVndaQkp0TExiUVBYS0xIcG9LckRRejExM1BmSnJrRSJ9LCJleHAiOjE3MzcwMDIxMDh9.psK5D96hgISDXgRSUEgRB6KoaukwkqmfOhsXp8acCPQ", // Replace with your actual token
                'Accept': 'application/json'
            },
        });

        if (!response.ok) {
            throw new Error(`State (city) API returned status: ${response.status}`);
        }

        const data = await response.json();
        const states = data; // The response returns states directly

        // Populate the city dropdown (states in your case)
        cityDropdown.innerHTML = '<option value="">Select City</option>';
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state.state_name; // Use the correct field from API response
            option.textContent = state.state_name;
            cityDropdown.appendChild(option);
        });

        // Clear the area dropdown since it's dependent on the city
        areaDropdown.innerHTML = '<option value="">Select Area</option>';
    } catch (error) {
        console.error('Error fetching states (cities):', error);
        alert('Could not fetch cities. Please try again.');
    }
}




// Handle city change to fetch areas
// Handle city change to fetch areas
async function handleCityChange(cityDropdown, areaDropdown) {
    const selectedCity = cityDropdown.value; // City is now a state in your naming convention
    if (!selectedCity) return;

    try {
        console.log('Fetching areas for city (state):', selectedCity);

        // Fetch areas (from cities API) for the selected city (state)
        const response = await fetch(`https://www.universal-tutorial.com/api/cities/${selectedCity}`, {
            method: 'GET',
            headers: {
                "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiIyMHA2MDIyQGVuZy5hc3UuZWR1LmVnIiwiYXBpX3Rva2VuIjoiWlpGVXZWdlV4WlVEVWd2SWdINVZOSGNOVXY5STdHa2NUTWhoVndaQkp0TExiUVBYS0xIcG9LckRRejExM1BmSnJrRSJ9LCJleHAiOjE3MzcwMDIxMDh9.psK5D96hgISDXgRSUEgRB6KoaukwkqmfOhsXp8acCPQ", // Replace with your actual token
                'Accept': 'application/json'
            },
        });

        if (!response.ok) {
            throw new Error(`Area API returned status: ${response.status}`);
        }

        const data = await response.json();
        const areas = data; // The response returns areas directly

        // Populate the area dropdown
        areaDropdown.innerHTML = '<option value="">Select Area</option>';
        areas.forEach(area => {
            const option = document.createElement('option');
            option.value = area.city_name; // Use the correct field from API response
            option.textContent = area.city_name;
            areaDropdown.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching areas:', error);
        alert('Could not fetch areas. Please try again.');
    }
}

document.addEventListener('DOMContentLoaded', fetchCountries);

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

    function updateLocations(UserID, VolunteerID, locationID, area, city, country) {
        console.log('Updating location...');
        console.log('UserID:', UserID);
        console.log('VolunteerID:', VolunteerID);
        console.log('LocationID:', locationID);
        console.log('Area:', area);
        console.log('City:', city);
        console.log('Country:', country);

        const locations = []; // To store the selected locations

// Loop through all the dropdowns, assuming they are in corresponding order
for (let i = 0; i < areaDropdowns.length; i++) {
    const areaDropdown = areaDropdowns[i];
    const cityDropdown = cityDropdowns[i];
    const countryDropdown = countryDropdowns[i];

    const selectedArea = areaDropdown.value;
    const selectedCity = cityDropdown.value;
    const selectedCountry = countryDropdown.value;

    // Check if all values are selected before adding to locations
    if (selectedArea && selectedCity && selectedCountry) {
        locations.push({
            area: selectedArea,
            city: selectedCity,
            country: selectedCountry,
        });
    }
}

// Prepare the data for the server
const formData = new FormData();
formData.append('action', 'addLocation');
formData.append('VolunteerID', volunteerID);
formData.append('UserID', UserID);
formData.append('locations', JSON.stringify(locations)); // Convert to JSON string

    fetch('VolunteerProfileView.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log('Location updated:', data);
        })
        .catch(error => {
            console.error('Error updating location:', error);
        });


}

function toggleeditModeforLocations(UserID, VolunteerID, locationID, country, city, area) {
    console.log('Toggling edit mode for locations...');
    let updatedValues = {};

    const locationBox = document.querySelector(`#location-${locationID}`);
    const displayFields = locationBox.querySelectorAll(`p`);
    const editFields = locationBox.querySelectorAll(`select`);
    const saveButton = locationBox.querySelector(`button[onclick^="updateLocations"]`);

    // Toggle visibility of display and edit fields
    displayFields.forEach(field => {
        field.style.display = field.style.display === 'none' ? '' : 'none';
    });

    editFields.forEach(field => {
        field.style.display = field.style.display === 'none' ? '' : 'block';
        updatedValues[field.id] = field.value;
        console.log("Field is", field);
    });

    // Dynamically update the Save button's `onclick` when the dropdowns are visible
    saveButton.style.display = saveButton.style.display === 'none' ? '' : 'inline-block';
    console.log("location id to be deleted", locationID);

    // Update the save button's `onclick` with correct values after the loop
    saveButton.setAttribute('onclick', `updateLocations(
        ${UserID},
        ${VolunteerID},
        ${locationID},
        "${updatedValues[`area-edit-${locationID}`] || area}",
        "${updatedValues[`city-edit-${locationID}`] || city}",
        "${updatedValues[`country-edit-${locationID}`] || country}"
    )`);
}





function toggleEditMode(locationid, id, organizationName, startDate, endDate, eventName, eventDescription, area, city, country) { 
    const displayFields = document.querySelectorAll(`#card${id} span, #card${id} p`);
    const editFields = document.querySelectorAll(`#card${id} input, #card${id} textarea, #card${id} select`);
    const saveButton = document.getElementById(`saveButton${id}`);
    console.log("now in toggle edit mode");
    console.log("city is", city);
    console.log("country is", country);
    console.log("area is", area);
    
    let updatedValues = {};
    
    // Toggle the visibility of the display fields
    displayFields.forEach(field => {
        field.style.display = field.style.display === 'none' ? '' : 'none';
    });

    // Toggle the visibility of the editable fields and set up event listeners for dynamic updates
    editFields.forEach(field => {
        // Set up event listener for each editable field
        field.addEventListener('input', (e) => {
            updatedValues[field.id] = e.target.value;  // Update the value dynamically
            console.log(updatedValues); // Debugging to log the updated values
            console.log(field.id);
            console.log(locationid);

            // Update the onclick for the save button with the latest dynamic values
            saveButton.setAttribute('onclick', `saveChanges(
                "${updatedValues['organizationNameEdit' + id] || organizationName}",
                "${updatedValues['startDateEdit' + id] || startDate}",
                "${updatedValues['endDateEdit' + id] || endDate}",
                "${updatedValues['eventNameEdit' + id] || eventName}",
                "${updatedValues['eventDescriptionEdit' + id] || eventDescription}",
                "${updatedValues['area-edit-' + locationid] || area}",
                "${updatedValues['city-edit-' + locationid] || city}",
                "${updatedValues['country-edit-' + locationid] || country}",
                ${id},
            )`);
        });

        // Toggle the display for the editable fields
        field.style.display = field.style.display === 'none' ? '' : 'block';
    });


    // Make the save button visible
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

    function saveChanges(OrganizationName, StartDate, EndDate, EventName, EventDescription, area, city, country, VolunteerHistoryID) {
        console.log('Saving changes...');


        console.log("Values to Save: ", OrganizationName, StartDate, EndDate, EventName, EventDescription, VolunteerHistoryID);

    


        formData = new FormData();
        formData.append('action', 'editVolunteerHistory');
        formData.append('VolunteerHistoryID', VolunteerHistoryID);
        formData.append('OrganizationName', OrganizationName);
        formData.append('StartDate', StartDate);
        formData.append('EndDate', EndDate);
        formData.append('EventName', EventName);
        formData.append('EventDescription', EventDescription);
       
       formData.append('Area', area);
         formData.append('City', city);
            formData.append('Country', country);
       
  


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

    function addVolunteerHistory(VolunteerID, organization, startDate, endDate, eventName, eventDescription, countryDropdown, cityDropdown, areaDropdown) {
        console.log('Adding volunteer history...');
        console.log('VolunteerID:', VolunteerID);
        const locations = []; // To store the selected locations
        const areaDropdowns = document.querySelectorAll('.area-dropdown');
const cityDropdowns = document.querySelectorAll('.city-dropdown');
const countryDropdowns = document.querySelectorAll('.country-dropdown');
    // Loop through all the dropdowns, assuming they are in corresponding order
    for (let i = 0; i < areaDropdowns.length; i++) {
        const areaDropdown = areaDropdowns[i];
        const cityDropdown = cityDropdowns[i];
        const countryDropdown = countryDropdowns[i];

        const selectedArea = areaDropdown.value;
        const selectedCity = cityDropdown.value;
        const selectedCountry = countryDropdown.value;

        // Check if all values are selected before adding to locations
        if (selectedArea && selectedCity && selectedCountry) {
            locations.push({
                area: selectedArea,
                city: selectedCity,
                country: selectedCountry,
            });
        }
    }

        const formData = new FormData();
        formData.append('action', 'addVolunteerHistory');
        formData.append('volunteerOrganization', organization);
        formData.append('volunteerStartDate', startDate);
        formData.append('volunteerEndDate', endDate);
        formData.append('EventName', eventName);
        formData.append('EventDescription', eventDescription);
        formData.append('locations', JSON.stringify(locations)); // Convert to JSON string
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








</script>
