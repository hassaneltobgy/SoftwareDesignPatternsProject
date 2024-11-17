<?php
require_once '../Models/VolunteerModel.php';  
class VolunteerController {
    private $volunteerModel;

    public function __construct() {
        $this->volunteerModel = new Volunteer();
    }

    // Get all volunteers and pass them to the view
    public function getAllVolunteers() {
        return Volunteer::SelectAllVolunteersInDB();
    }
    public function updateVolunteer($data) {
       
        $volunteer = new Volunteer($data['VolunteerID']);
    
        if ($volunteer->update(
            $data['VolunteerID'],
            $data['FirstName'],
            $data['LastName'],
            $data['Email'],
            $data['PhoneNumber'],
            $data['DateOfBirth'],
            $data['USER_NAME'],
            $data['PASSWORD_HASH'],
            $data['hours_contributed'],
            $data['NumberOfEventsAttended'],
            $data['badge_name']
        )) {
            $firstName = $volunteer->FirstName;
            $lastName = $volunteer->LastName;
            $email = $volunteer->Email;
            $phoneNumber = $volunteer->PhoneNumber;
            $hoursContributed = $volunteer->hours_contributed;
            $numberOfEventsAttended = $volunteer->NumberOfEventsAttended;
            $DateOfBirth = $volunteer->DateOfBirth;
            $UserName = $volunteer->USER_NAME;
            $PasswordHash = $volunteer->PASSWORD_HASH;
            $badge_name = $volunteer->badge->get_title();


            

        } else {
        }
    }
    
    
    // Create a new volunteer
    public function createVolunteer($data) {
        // Collect form data for volunteer creation
        $FirstName = $data['FirstName'];
        $LastName = $data['LastName'];
        $Email = $data['Email'];
        $PhoneNumber = $data['PhoneNumber'];
        $DateOfBirth = $data['DateOfBirth'];
        $USER_NAME = $data['USER_NAME'];
        $PASSWORD_HASH = $data['PASSWORD_HASH'];
        $LAST_LOGIN = $data['LAST_LOGIN'];
        $ACCOUNT_CREATION_DATE = $data['ACCOUNT_CREATION_DATE'];
        $hours_contributed = $data['hours_contributed'];
        $NumberOfEventsAttended = $data['NumberOfEventsAttended'];
   
        $skills = !empty($data['skills']) ? explode(',', $data['skills']) : [];
        $volunteer_history = !empty($data['volunteer_history']) ? explode(',', $data['volunteer_history']) : [];
        $badge_name = $data['badge_name'];


        $volunteer = Volunteer::create_Volunteer(
            $FirstName,
            $LastName,
            $Email,
            $PhoneNumber,
            $DateOfBirth,
            $USER_NAME,
            $PASSWORD_HASH,
            $LAST_LOGIN,
            $ACCOUNT_CREATION_DATE,
            $hours_contributed,
            $NumberOfEventsAttended,
            $skills,  // pass $skills correctly as an array
            $volunteer_history,  // pass $volunteer_history correctly as an array
            $badge_name // pass $badge_name directly as a value
        );
        
        
        return $volunteer;
    }


    // Delete a volunteer by ID
    public function deleteVolunteer($id) {
        $volunteer = new Volunteer($id);
        return $volunteer->delete();
    }
}

// Handle POST actions outside the class
// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $volunteerController = new VolunteerController();
    switch ($_POST['action']) {
        case 'addUserAndVolunteer':
            $data = [
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'Email' => $_POST['Email'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'DateOfBirth' => $_POST['DateOfBirth'],
                'USER_NAME' => $_POST['USER_NAME'],
                'PASSWORD_HASH' => $_POST['PASSWORD_HASH'],
                'LAST_LOGIN' => $_POST['LAST_LOGIN'],
                'ACCOUNT_CREATION_DATE' => $_POST['ACCOUNT_CREATION_DATE'],
                'hours_contributed' => $_POST['hours_contributed'],
                'NumberOfEventsAttended' => $_POST['NumberOfEventsAttended'],
                'badge_name' => $_POST['badge_name'],
                'skills' => $_POST['skills'],
                'volunteer_history' => $_POST['volunteer_history']
            ];
            $volunteerController->createVolunteer($data);
            break;

        case 'updateVolunteer':

            $data = [
                'VolunteerID' => $_POST['VolunteerID'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'Email' => $_POST['Email'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'DateOfBirth' => $_POST['DateOfBirth'],
                'USER_NAME' => $_POST['USER_NAME'],
                'PASSWORD_HASH' => $_POST['PASSWORD_HASH'],
                'hours_contributed' => $_POST['hours_contributed'],
                'NumberOfEventsAttended' => $_POST['NumberOfEventsAttended'],
                'badge_name' => $_POST['badge_name'],
            ];
            $volunteerController->updateVolunteer($data);
            break;
        case 'deleteVolunteer':
            $volunteerController->deleteVolunteer($_POST['VolunteerID']);
            break;
    }
}

?>
