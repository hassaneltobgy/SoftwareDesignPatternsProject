<?php
require_once '../Models/VolunteerModel.php';
require_once '../Models/VolunteerHistoryModel.php';
require_once '../Models/VolunteerFeedbackModel.php';
require_once '../Models/Event.php';
require_once '../Models/EventFeedbackModel.php';
require_once '../Models/SkillTypeModel.php';
require_once '../Models/SkillsModel.php';
require_once '../Models/NotificationType.php';
require_once '../Models/OrganizationModel.php';

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


    public function addLocation($area, $country, $city, $volunteerID, $userid, $locationID)
{
    echo "country is " . $country;
    echo "city is " . $city;
    echo "area is " . $area;


        $Volunteer = new Volunteer();

      
        $areaID = Location::getLocationID($area);
        echo "AreaID is " . $areaID;
        if ($areaID == null) {
            echo "AreaID is null";
            
            $location = Location::create(Name:$country, ParentID:null);
            $countryID = $location->AddressID;

            $location = Location::create(Name:$city, ParentID:$countryID);
            $cityID = $location->AddressID;

            $location = Location::create(Name:$area, ParentID:$cityID);
            $areaID = $location->AddressID;


            
        }
        $Volunteer->addLocation($areaID, $userid, $locationID);
        
    
    
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
    public function getallorganizationNames() {
        return Organization::getallorganizationNames();
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

    public function editVolunteerHistory($VolunteerHistoryID, $OrganizationName, $StartDate, $EndDate, $EventName, $EventDescription, $area, $city, $country) {
        $volunteerHistory = new VolunteerHistory($VolunteerHistoryID);
        echo "country is " . $country;
        echo "city is " . $city;
        echo "area is " . $area;
      

        // // trim all the white spaces
        // $location[0] = trim($location[0]);
        // $location[1] = trim($location[1]);
        // $location[2] = trim($location[2]);
        $locationidCountry = Location::getLocationID($country); // parent id to city
        $locationidCity = Location::getLocationID($city); // parent id to area
        $locationidArea = Location::getLocationID($area);


        // create an object for location that has parent id to city
        $locationEvent = new Location($locationidArea,$area, $locationidCity);
       

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

    public function insertCountriesIntoDB($countries) {
        set_time_limit(300); // Increase the maximum execution time to 5 minutes
    foreach ($countries as $country) {
        $countryID = Location::getLocationID($country);
        if ($countryID == null) {
            $location= Location::create(Name: $country, ParentID:null);
            $countryID = $location->AddressID;
            
            // now get the corresponding city using the same api 
            $apiUrl = "https://www.universal-tutorial.com/api/states/$country";
            $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJmYXJpZGFlbGh1c3NpZW55QGdtYWlsLmNvbSIsImFwaV90b2tlbiI6InJKeVM2aG5hWFBiZXRPcTZXdkpJVzE2azNabXFpWFhmbzRzQXlHeU52YkFiUGFyMmJOcVRjeEttR3lWVG0yYkZUc28ifSwiZXhwIjoxNzM1ODUyMDE0fQ._ndiabnbzMXim1R87xxTF60CJIOU1QgGd95hJDiVrTY"; // Replace with your actual token

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $token",
                "Accept: application/json"
            ]);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable peer verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Disable host verification
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                echo "Error fetching cities for $country.";
                continue;
            }
            $cities = json_decode($response, true);
            if ($cities === null) {
                echo "Error decoding cities for $country. Invalid JSON response.";
                continue;
            }
            $cityNames= array_map(function($state) {
                return $state['state_name']; // Extracting only the state name
            }, $cities);
            $cityNames = array_unique($cityNames); // Remove duplicates
            

            foreach ($cityNames as $city) {
                $cityID = Location::getLocationID($city);
                if ($cityID == null) {
                    $location = Location::create(Name:$city, ParentID:$countryID);
                    $cityID = $location->AddressID;
            
                    // Now get the corresponding area using the same API 
                    $apiUrl = "https://www.universal-tutorial.com/api/cities/$city";
                    $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJmYXJpZGFlbGh1c3NpZW55QGdtYWlsLmNvbSIsImFwaV90b2tlbiI6InJKeVM2aG5hWFBiZXRPcTZXdkpJVzE2azNabXFpWFhmbzRzQXlHeU52YkFiUGFyMmJOcVRjeEttR3lWVG0yYkZUc28ifSwiZXhwIjoxNzM1ODUyMDE0fQ._ndiabnbzMXim1R87xxTF60CJIOU1QgGd95hJDiVrTY"; // Replace with your actual token
            
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $apiUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Authorization: Bearer $token",
                        "Accept: application/json"
                    ]);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable peer verification
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // Disable host verification
                    $response = curl_exec($ch);
            
                    // Check for curl error
                    if ($response === false) {
                        echo "Error fetching areas for $city: " . curl_error($ch);
                        curl_close($ch);
                        continue;
                    }
                    curl_close($ch);
            
                    // Output the raw response for debugging
                    echo "Raw response for $city: " . $response . "<br>";
            
                    // Decode the response into an associative array
                    $areas = json_decode($response, true);
            
                    // Check if the response is valid
                    if ($areas === null) {
                        echo "Error decoding areas for $city. Invalid JSON response.";
                        continue;
                    }
            
                    // Check if $areas is an array and has elements
                    if (is_array($areas) && !empty($areas)) {
                        $areaNames = array_map(function($area) {
                            return $area['city_name']; // Extracting only the area name
                        }, $areas);
            
                       
            
                        // Remove duplicates
                        $areaNames = array_unique($areaNames);
            
                        // Now process the area names
                        foreach ($areaNames as $area) {
                            $areaID = Location::getLocationID($area);
                            if ($areaID == null) {
                                $areaID = Location::create(Name:$area, ParentID:$cityID);
                            }
                        }
                    } else {
                        echo "No areas found for $city.";
                    }
                }
            }
            
            

        }
    }
    }

    public function updateLocation($area, $country, $city, $volunteerID, $userID) {
        $Volunteer = new Volunteer();
        $areaID = Location::getLocationID($area);
        $Volunteer->updateLocation( $userID, $country, $city, $area);

    
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

    case 'updateLocation':

        $userID = $_POST['UserID'];
        $volunteerID = $_POST['VolunteerID'];
        $area = $_POST['Area'];
        $city = $_POST['City'];
        $country = $_POST['Country'];
        $VolunteerController->updateLocation($area, $country, $city, $volunteerID, $userID);
        break;


    
    case 'addLocation':
        echo "I HAVE RECEIVED ACTION ADD LOCATION";
        $userid = $_POST['UserID'];
        $locationID = $_POST['LocationID'];
        $volunteerID = $_POST['VolunteerID'];
        $locationsJson = $_POST['locations']; // Get the JSON string
        $locations = json_decode($locationsJson, true); // Decode JSON string into PHP array

        if (is_array($locations)) { // Ensure it's an array
            foreach ($locations as $location) {
                $area = $location['area'];         // Access area
                $city = $location['city'];         // Access city
                $country = $location['country'];   // Access country

                // Do something with the area, city, and country
                echo "Area: $area, City: $city, Country: $country\n";
            }
        } else {
            echo "Locationn data is $locationsJson\n";
            echo "Locations data is invalid!";
        }

        $VolunteerController->addLocation($area,$country, $city, $volunteerID, $userid, $locationID);
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
        $locationsJson = $_POST['locations']; // Get the JSON string

        $locations = json_decode($locationsJson, true); // Decode JSON string into PHP array

        if (is_array($locations)) { // Ensure it's an array
            foreach ($locations as $location) {
                $area = $location['area'];         // Access area
                $city = $location['city'];         // Access city
                $country = $location['country'];   // Access country

                // Do something with the area, city, and country
                echo "Area: $area, City: $city, Country: $country\n";
            }
        } else {
            echo "Locationn data is $locationsJson\n";
            echo "Locations data is invalid!";
        }
        $VolunteerController->addVolunteerHistory( $_POST['VolunteerID'], $_POST['volunteerOrganization'],
         $_POST['volunteerStartDate'], $_POST['volunteerEndDate'], $_POST['EventName'], $_POST['EventDescription'], 
        $country, $city, $area);
        break;
    
    case 'deleteVolunteerHistory':
        $VolunteerController->deleteVolunteerHistory($_POST['VolunteerHistoryID'], $_POST['VolunteerID']);
        break;


    case 'editVolunteerHistory':
       $city  = $_POST['City'];
         $area = $_POST['Area'];
            $country = $_POST['Country'];

        $VolunteerController->editVolunteerHistory($_POST['VolunteerHistoryID'], $_POST['OrganizationName'],
        $_POST['StartDate'], $_POST['EndDate'], $_POST['EventName'], $_POST['EventDescription'], $area, $city, $country);
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
