<?php
require_once '../Models/VolunteerModel.php';
class VolunteerController {
    private $VolunteerModel;
    public function __construct() {
        $this->VolunteerModel = new Volunteer();
    }

    public function get_all_Volunteers() {
        return Volunteer::getAllVolunteers();
    }

    public function getVolunteerbyId($id) {
        echo "getting volunteer by id in controller $id"; 
        return Volunteer::get_volunteer_by_id($id);
    }

    
    public function updateVolunteerBadge($data) {
        $Volunteer = new Volunteer($data['VolunteerID']);
        $Volunteer->Update_badge($data['BadgeName']);

    }
    public function editProfileData($firstName, $lastName, $email, $phoneNumber, $dateOfBirth, $userName, $countries, $cities, $areas, $hoursContributed, $numberOfEventsAttended, $volunteerID) {
        $Volunteer = new Volunteer($volunteerID);
        // for loop on length of countries array
        if (count($countries)!=0){
        for ($i = 0; $i < count($countries); $i++) {
            $Volunteer->update(FirstName:$firstName, LastName:$lastName, Email:$email, PhoneNumber:$phoneNumber, DateOfBirth:$dateOfBirth, USER_NAME:$userName, country:$countries[$i], city:$cities[$i], area:$areas[$i], hours_contributed:$hoursContributed, NumberOfEventsAttended:$numberOfEventsAttended, VolunteerID:$volunteerID);
        }
    }
    else {
        $Volunteer->update(FirstName:$firstName, LastName:$lastName, Email:$email, PhoneNumber:$phoneNumber, DateOfBirth:$dateOfBirth, USER_NAME:$userName, hours_contributed:$hoursContributed, NumberOfEventsAttended:$numberOfEventsAttended, VolunteerID:$volunteerID);
    }
    
    }

    public function addLocation($countries, $cities, $areas, $volunteerID, $userid)
    {
        $Volunteer = new Volunteer();
       for ($i = 0; $i < count($countries); $i++) {
        echo "country added is " . $countries[$i];
        echo "city added is " . $cities[$i];
        echo "area added is " . $areas[$i];
        echo "volunteer id is " . $volunteerID;
        echo "user id is " . $userid;
            $Volunteer->update(country:$countries[$i], city:$cities[$i], area:$areas[$i], VolunteerID:$volunteerID, UserID:$userid);
        }   
    }

    public function deleteLocation($id, $userID) {
        $Volunteer = new Volunteer();
        $Volunteer->removeLocation($id, $userID);
    }
   
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $VolunteerController = new VolunteerController();
    echo "received action";
    echo "action is " . $_POST['action'];
    switch ($_POST['action']) {
        case 'updateBadgeAssignment':
            $data = [
                'VolunteerID' => $_POST['VolunteerID'],
                'BadgeName' => $_POST['BadgeName'],

            ];
            $VolunteerController->updateVolunteerBadge($data);
            break;
   
    
    case 'editProfileData':
        echo "editProfileData";

    
        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $email = $_POST["Email"];
        $phoneNumber = $_POST["PhoneNumber"];
        $dateOfBirth = $_POST["DateOfBirth"];
        $userName = $_POST["USER_NAME"];
        $countries = $_POST['Country']?? []; // Array of countries
        $cities = $_POST['City']?? []; // Array of cities
        $areas = $_POST['Area']?? []; // Array of areas 
        $hoursContributed = $_POST["hours_contributed"];
        $numberOfEventsAttended = $_POST["NumberOfEventsAttended"];
        $volunteerID = $_POST["VolunteerID"];
        $VolunteerController->editProfileData($firstName, $lastName, $email, $phoneNumber, $dateOfBirth, $userName, $countries, $cities, $areas, $hoursContributed, $numberOfEventsAttended, $volunteerID);
        break;
    

    case "deleteLocation":
        echo "action is deleteLocation";

        $id = $_POST['LocationID'];
        $VolunteerController->deleteLocation($id, $_POST['UserID']);
        break;
    
    case 'addLocation':
        $userid = $_POST['UserID'];
        $volunteerID = $_POST['VolunteerID'];
        $countries = $_POST['Country']?? []; // Array of countries
        $cities = $_POST['City']?? []; // Array of cities
        $areas = $_POST['Area']?? []; // Array of areas
        $VolunteerController->addLocation($countries, $cities, $areas, $volunteerID, $userid);
        break;

    }

}

?>
