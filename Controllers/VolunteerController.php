<?php
require_once '../Models/VolunteerModel.php';
require_once '../Models/VolunteerHistoryModel.php';
require_once '../Models/VolunteerFeedbackModel.php';
require_once '../Models/Event.php';
require_once '../Models/EventFeedbackModel.php';
require_once '../Models/SkillTypeModel.php';
require_once '../Models/SkillsModel.php';
require_once '../Models/NotificationType.php';

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

    public function getBadgeIdByName($badge_name) {
        return VolunteerBadge::getBadgeIdByName($badge_name);
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

    public function addEmergencyContact($Name, $PhoneNumber, $volunteerID) {
        $volunteer = new Volunteer($volunteerID);
        $volunteer->addEmergencyContact($Name, $PhoneNumber);
    }
    public function deleteEmergencyContact($volunteerID, $contactID) {
        $volunteer = new Volunteer($volunteerID);
        $volunteer->removeEmergencyContact($contactID);
    }
   
    public function addVolunteerHistory($VolunteerID, $volunteerOrganization, $volunteerStartDate, $volunteerEndDate, $EventName, $EventDescription, $EventCountry, $EventCity, $EventArea) {
        
        echo "VolunteerID is " . $VolunteerID;
        
        $locationidCountry = Location::getLocationID($EventCountry); // parent id to city 
        $locationidCity = Location::getLocationID($EventCity); // parent id to area
        $locationidArea = Location::getLocationID($EventArea); 

        // create an object for location that has parent id to city
        $locationEvent = Location::create($locationidArea,$EventArea, $locationidCity);
        
        // create an event entry with event name, event description, organization name, event country, event city, event area
        $event = Event::create($EventName, $volunteerStartDate, $locationEvent, $EventDescription, $volunteerOrganization);
        // then create volunteer history object that takes the event object as well as start date and end date
        $volunteerHistory = VolunteerHistory::create($volunteerStartDate, $volunteerEndDate, $event);

        // add the volunteer history to the volunteer itself 
        $volunteer = new Volunteer($VolunteerID);
        $volunteer->add_history($volunteerHistory);
    

    }

    public function deleteVolunteerHistory($VolunteerHistoryID, $VolunteerID) {
        $volunteer = new Volunteer($VolunteerID);
        $volunteer->remove_history($VolunteerHistoryID);
    }

    public function editVolunteerHistory($VolunteerHistoryID, $OrganizationName, $StartDate, $EndDate, $EventName, $EventDescription, $EventLocation) {
        $volunteerHistory = new VolunteerHistory($VolunteerHistoryID);

      
        $location = explode(",", $EventLocation);

        // trim all the white spaces
        $location[0] = trim($location[0]);
        $location[1] = trim($location[1]);
        $location[2] = trim($location[2]);
        $locationidCountry = Location::getLocationID($location[0]); // parent id to city
        $locationidCity = Location::getLocationID($location[1]); // parent id to area
        $locationidArea = Location::getLocationID($location[2]);


        // create an object for location that has parent id to city
        $locationEvent = new Location($locationidArea,$location[2], $locationidCity);
       

        $event = Event::create($EventName, $StartDate, $locationEvent, $EventDescription, $OrganizationName);
     
        $volunteerHistory->update($StartDate, $EndDate, $event);

        

    }
    public function addSkill($VolunteerID, $SkillName, $SkillLevel, $skillTypes) {
        $volunteer = new Volunteer($VolunteerID);
        $skillTypes = explode(",", $skillTypes);
        // convert the skill types to an array of objects
        // echo "skill types are " . $skillTypes;
        for ($i = 0; $i < count($skillTypes); $i++) {
            $skillTypes[$i] = new SkillType(SkillTypeName: $skillTypes[$i]);
        }
        for ($i = 0; $i < count($skillTypes); $i++) {
            $skill = new Skill(SkillName: $SkillName, SkillLevel: $SkillLevel, SkillTypes: $skillTypes);
            $volunteer->add_skill($skill);
        }
   
    }
    public function getAllSkillTypes() {
        return SkillType::read_all();
    }
    public function deleteSkill($volunteerID, $skillID) {
        $volunteer = new Volunteer($volunteerID);
        $volunteer->remove_skill($skillID);
    }

    public function get_notification_types($UserID){
        return User::get_notification_types($UserID);
    }
    public function get_all_notification_types(){
        return NotificationType::get_all();
    }

    public function updateNotificationSettings($UserID, $notificationTypes) {
        echo "NotificationTypes in controller are " . $notificationTypes;
        $user = new User($UserID);
        $user->update_Notification_Types($notificationTypes);
    }   

    public function updateEmergencyContact($VolunteerID, $ContactID, $ContactName, $ContactPhone) {
        $emergencyContact = EmergencyContact::create($ContactName, $ContactPhone);
        $volunteer = new Volunteer($VolunteerID);  
        $volunteer->updateEmergencyContact($ContactID, $emergencyContact); 
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

    
    case 'addEmergencyContact':
        echo "I HAVE RECEIVED ACTION ADD EMERGENCY CONTACT";
        $Name = $_POST['ContactName'];
        $volunteerID = $_POST['VolunteerID'];
        $PhoneNumber = $_POST['ContactPhone'];
        echo "now calling addEmergencyContact from controller";
        $VolunteerController->addEmergencyContact($Name, $PhoneNumber, $volunteerID);

        break;

    case 'deleteContact':
        echo "deleteContact";
        $volunteerID = $_POST['VolunteerID'];
        $contactID = $_POST['ContactID'];
        $VolunteerController->deleteEmergencyContact($volunteerID, $contactID);
        break;

    
    case 'addVolunteerHistory':
        $VolunteerController->addVolunteerHistory( $_POST['VolunteerID'], $_POST['volunteerOrganization'],
         $_POST['volunteerStartDate'], $_POST['volunteerEndDate'], $_POST['EventName'], $_POST['EventDescription'], 
        $_POST['EventCountry'], $_POST['EventCity'], $_POST['EventArea']);
        break;
    
    case 'deleteVolunteerHistory':
        $VolunteerController->deleteVolunteerHistory($_POST['VolunteerHistoryID'], $_POST['VolunteerID']);
        break;


    case 'editVolunteerHistory':
        echo "editHistory";
        $VolunteerController->editVolunteerHistory($_POST['VolunteerHistoryID'], $_POST['OrganizationName'],
        $_POST['StartDate'], $_POST['EndDate'], $_POST['EventName'], $_POST['EventDescription'], 
        $_POST['EventLocation']);
        break;

    case 'addSkill':
        $VolunteerController->addSkill($_POST['VolunteerID'], $_POST['SkillName'], $_POST['SkillLevel'], $_POST['SkillTypes']);
        break;


    case 'deleteSkill':
        echo "deleteSkill";
        $volunteerID = $_POST['VolunteerID'];
        $skillID = $_POST['SkillID'];
        $VolunteerController->deleteSkill($volunteerID, $skillID);
        break;

    case  'updateNotificationSettings':
        echo "updateNotificationSettings";
        $UserID = $_POST['UserID'];
        $notificationTypes = $_POST['notificationTypes'];
        $VolunteerController->updateNotificationSettings($UserID, $notificationTypes);
        break;

    case 'updateEmergencyContact':
        echo "updateEmergencyContact";
        $VolunteerController->updateEmergencyContact($_POST['VolunteerID'], $_POST['ContactID'], $_POST['Name'], $_POST['Phone']);
        break;
    }
}

?>
