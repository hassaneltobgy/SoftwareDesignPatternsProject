<?php
require_once 'UserModel.php';  
require_once 'BadgeDecorator.php';  
require_once 'EmergencyContactModel.php';
require_once 'VolunteerHistoryModel.php';
require_once 'Event.php';
require_once 'SkillsModel.php';
require_once 'ImageProxy.php';
require_once 'BadgeFactory.php';
require_once 'AddSkill.php';
require_once 'ISkillCommand.php';
require_once 'RemoveSkill.php';
class Volunteer extends User {
    public $VolunteerID;   
    public $UserID; 
    public $hours_contributed;
    public $NumberOfEventsAttended;
    public $skills = [];  
    public $volunteer_history = [];  
    public $badge;  
    public $EmergencyContacts=[];   
    private $conn;
    private $ProxyImage;
    private $table_name = "Volunteer";
    private $ISkillCommand;


    public function __construct($id = null) {
        $this->table_name = "Volunteer";
        $this->conn = Database::getInstance()->getConnection();
    
        if (!$this->conn) {
            echo "Database connection error.";
            return;
        } else if (empty($id)) {
            return;
        } else {
            $sql = "SELECT * FROM $this->table_name WHERE VolunteerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                // First initialize the User class with the UserID from Volunteer record
                parent::__construct($row['UserID']);  // This initializes the parent (User) class
    
                // Now initialize the Volunteer class properties
                $this->VolunteerID = $row['VolunteerID'];
                $this->UserID = $row['UserID'];
                $this->hours_contributed = $row['hours_contributed'];
                $this->NumberOfEventsAttended = $row['NumberOfEventsAttended'];
                $this->skills = $this->get_skills();
                $this->volunteer_history = $this->get_history();
                $this->badge = $this->get_badge();
                $this->EmergencyContacts = $this->getEmergencyContacts();
                $this->ProxyImage = $this->getProxyImageObject($row['ImageUrl']);
            } else {
                echo "No volunteer found with ID: $id";
            }
    
            $stmt->close();
        }
    }
    
    public function getProxyImageObject($imageUrl) {
        return new ProxyImage($imageUrl);
    }
    public function getProxyImage()
    {
        return $this->ProxyImage;
    }

    static public function create_Volunteer(
        $FirstName, 
        $LastName= null, 
        $Email, 
        $PhoneNumber= null, 
        $DateOfBirth = null, 
        $USER_NAME, 
        $password= null, 
        $LAST_LOGIN, 
        $ACCOUNT_CREATION_DATE , 
        $privileges = [],
        $hours_contributed = null,
        $NumberOfEventsAttended= null,
        $skills = [],
        $volunteer_history = [],
        $badge_name = null,
        
        ) 
        
        {


        $userCreated = parent::create(
        $FirstName, 
        $LastName, 
        $Email, 
        $PhoneNumber, 
        $DateOfBirth = null, 
        $USER_NAME, 
        $password ? password_hash($password, PASSWORD_BCRYPT): null,
        $LAST_LOGIN, 
        $ACCOUNT_CREATION_DATE,
        "Volunteer",
        $privileges
        );  
      
        if ($userCreated) {
            echo "User created successfully.";
            $volunteer = new Volunteer();
    
            $query = "INSERT INTO " . $volunteer->table_name . " 
            (
                FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE,
                hours_contributed, NumberOfEventsAttended, VolunteerBadgeID, UserID, ImageUrl
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
            $conn = Database::getInstance()->getConnection();
            if (!$conn) {
                echo "Database connection error.";
                return null;
            }
            $stmt = $conn->prepare($query);
            if ($badge_name == null) {
                $badge_name = "Starter Badge";
            }
            
            $badge_id = VolunteerBadge::getBadgeIdByName($badge_name);
            
        $hours_contributed = (int)$hours_contributed;
        $NumberOfEventsAttended = (int)$NumberOfEventsAttended;
        $badge_id = (int)$badge_id;
        $UserId = $userCreated->UserID;
        $volunteer->UserID = $UserId;
        $volunteer->FirstName = $FirstName;
        $volunteer->LastName = $LastName;
        $volunteer->Email = $Email;
        $volunteer->PhoneNumber = $PhoneNumber;
        $volunteer->DateOfBirth = $DateOfBirth;
        $volunteer->USER_NAME = $USER_NAME;
        $volunteer->PASSWORD_HASH = $password?password_hash($password, PASSWORD_BCRYPT):null;
        $volunteer->LAST_LOGIN = $LAST_LOGIN;
        $volunteer->ACCOUNT_CREATION_DATE = $ACCOUNT_CREATION_DATE;
        $volunteer->hours_contributed = $hours_contributed;
        $volunteer->NumberOfEventsAttended = $NumberOfEventsAttended;
        $volunteer->badge= $volunteer->get_badge_by_name($badge_name);
        $standardImage = "D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303043.jpeg";
        $volunteer->ProxyImage = $volunteer->getProxyImageObject($standardImage);
        

        $password_hash = $password?password_hash($password, PASSWORD_BCRYPT):null;

        $stmt->bind_param(
            "sssssssssiiiis", 
            $FirstName, 
            $LastName, 
            $Email, 
            $PhoneNumber, 
            $DateOfBirth, 
            $USER_NAME, 
            $password_hash, 
            $LAST_LOGIN, 
            $ACCOUNT_CREATION_DATE, 
            $hours_contributed, 
            $NumberOfEventsAttended, 
            $badge_id,
            $UserId,
            $standardImage
            
        );
          
          
                
            if ($skills == []) {
                $skills = [];
            }
            if ($volunteer_history == []) 
            {
                $volunteer_history = [];
            }
            
            foreach ($skills as $skill) {
                $volunteer->add_skill($skill);
            }
            foreach ($volunteer_history as $history) {
                $volunteer->add_history($history);
            }
            if ($stmt->execute()) {
                $volunteer->VolunteerID = $conn->insert_id;
                return $volunteer;
            } else {
                echo "Error creating volunteer: " . $stmt->error;
            }
        } else {
            echo "Error creating user for volunteer.";
        }
    
        return null; 
    }   

    public function getEmergencyContacts() {
        // Fetch emergency contact details for the volunteer in one query
        $query = "
            SELECT ec.EmergencyContactName, ec.EmergencyContactPhone
            FROM EmergencyContact ec
            JOIN EmergencyContact_Volunteer ecv ON ec.EmergencyContactID = ecv.EmergencyContactID
            WHERE ecv.VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $EmergencyContacts = [];
    
        while ($row = $result->fetch_assoc()) {
            $emergencyContact = new EmergencyContact();
            $emergencyContact->setName($row['EmergencyContactName']);
            $emergencyContact->setPhoneNumber($row['EmergencyContactPhone']);
            $EmergencyContacts[] = $emergencyContact;
        }
    
        return $EmergencyContacts;
    }
    

    public function addEmergencyContact($Name, $PhoneNumber) {
        echo "now calling add emergency contact";
        $EmergencyContact= EmergencyContact::create($Name, $PhoneNumber);
        $EmergencyContactID = $EmergencyContact->getID();
        echo "now inserting emergency contact with id $EmergencyContactID";


        $query = "INSERT INTO EmergencyContact_Volunteer (EmergencyContactID, VolunteerID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $EmergencyContactID, $this->VolunteerID);
        if (!$stmt->execute()) {
            echo "Error adding emergency contact: " . $stmt->error;
            return false;
        }
        return true;
    }

    public function removeEmergencyContact($EmergencyContactID) {
        echo "now removing emergency contact with id $EmergencyContactID";
        $query = "DELETE FROM EmergencyContact_Volunteer WHERE EmergencyContactID = ? AND VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $EmergencyContactID, $this->VolunteerID);
        $stmt->execute();
    }

    public function updateEmergencyContact($emergencyContactIDtobedeleted, $emergencyContact) {
        // overwrite the old emergency contact with the new one in the database
        $query = "DELETE FROM EmergencyContact_Volunteer WHERE VolunteerID = ? AND EmergencyContactID = ?";
        $stmt = $this->conn->prepare($query);
        echo "emergency contact id to be deleted is " . $emergencyContactIDtobedeleted;
        echo "volunteer id is " . $this->VolunteerID;
        
        $stmt->bind_param("ii", $this->VolunteerID, $emergencyContactIDtobedeleted);
        $stmt->execute();
        echo "Name is " . $emergencyContact->getName() . " and phone number is " . $emergencyContact->getPhoneNumber();
        $this->addEmergencyContact($emergencyContact->getName(), $emergencyContact->getPhoneNumber());

    }

    public static function deletebyUserID($UserID) {
        $conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM Volunteer WHERE UserID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $UserID);
        if (!$stmt->execute()) {
             echo "Error deleting volunteer: " . $stmt->error;
            return false;
        }
        return true;
    }
    public static function get_volunteer_by_id($VolunteerID) {
        echo "getting volunteer by id $VolunteerID   ";
        $table_name = "Volunteer";
        $query = "SELECT * FROM $table_name WHERE VolunteerID = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->bind_param("i", $VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $volunteer = new Volunteer();
        $volunteer->VolunteerID = $row['VolunteerID'];
        $volunteer->UserID = $row['UserID'];
        $volunteer->FirstName = $row['FirstName'];
        $volunteer->LastName = $row['LastName'];
        $volunteer->Email = $row['Email'];
        $volunteer->PhoneNumber = $row['PhoneNumber'];
        $volunteer->DateOfBirth = $row['DateOfBirth'];
        $volunteer->USER_NAME = $row['USER_NAME'];
        $volunteer->PASSWORD_HASH = $row['PASSWORD_HASH'];
        $volunteer->LAST_LOGIN = $row['LAST_LOGIN'];
        $volunteer->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];
        $volunteer->hours_contributed = $row['hours_contributed'];
        $volunteer->NumberOfEventsAttended = $row['NumberOfEventsAttended'];
        $volunteer->skills = $volunteer->get_skills();
        $volunteer->volunteer_history = $volunteer->get_history();
        $volunteer->badge = $volunteer->get_badge();
        $volunteer-> ProxyImage = $volunteer->getProxyImageObject($row['ImageUrl']);
        return $volunteer;

    }


    public static function get_volunteer_by_email($email) {
        $table_name = "Volunteer";
        $query = "SELECT * FROM $table_name WHERE Email = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $volunteer = new Volunteer();
        $volunteer->VolunteerID = $row['VolunteerID'];
        $volunteer->UserID = $row['UserID'];
        $volunteer->FirstName = $row['FirstName'];
        $volunteer->LastName = $row['LastName'];
        $volunteer->Email = $row['Email'];
        $volunteer->PhoneNumber = $row['PhoneNumber'];
        $volunteer->DateOfBirth = $row['DateOfBirth'];
        $volunteer->USER_NAME = $row['USER_NAME'];
        $volunteer->PASSWORD_HASH = $row['PASSWORD_HASH'];
        $volunteer->LAST_LOGIN = $row['LAST_LOGIN'];
        $volunteer->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];
        $volunteer->hours_contributed = $row['hours_contributed'];
        $volunteer->NumberOfEventsAttended = $row['NumberOfEventsAttended'];
        $volunteer->skills = $volunteer->get_skills();
        $volunteer->volunteer_history = $volunteer->get_history();
        $volunteer->badge = $volunteer->get_badge();
        $volunteer-> ProxyImage = $volunteer->getProxyImageObject($row['ImageUrl']);
        return $volunteer;

    }

    public function getVolunteerID() {
        return $this->VolunteerID;
    }
    public function getUserID() {
        // get user id from volunteer id
        return $this->UserID;

    }
    public function get_hours_contributed() {
        return $this->hours_contributed;
    }
    public function get_NumberOfEventsAttended() {
        return $this->NumberOfEventsAttended;
    }
    public function get_volunteer_skills() {
        return $this->skills;
    }
    public function get_volunteer_history() {
        return $this->volunteer_history;
    }
    public function get_volunteer_badge() {
        return $this->badge;
    }
    public function getFirstName() {
        return $this->FirstName;
    }
    public function getLastName() {
        return $this->LastName;
    }
    public function getEmail() {
        return $this->Email;
    }
    public function getPhoneNumber() {
        return $this->PhoneNumber;
    }
    public function getDateOfBirth() {
        return $this->DateOfBirth;
    }
    public function getUSER_NAME() {
        return $this->USER_NAME;
    }
    public function getPASSWORD_HASH() {
        return $this->PASSWORD_HASH;
    }
    public function getLAST_LOGIN() {
        return $this->LAST_LOGIN;
    }
    public function getACCOUNT_CREATION_DATE() {
        return $this->ACCOUNT_CREATION_DATE;
    }
   





    public function getVolunteerIdByUserId($UserID) {
        $query = "SELECT VolunteerID FROM " . $this->table_name . " WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['VolunteerID'];
    }

    public function update(
        $UserID= null,
        $VolunteerID = null,
        $FirstName = null,
        $LastName = null,
        $Email = null,
        $PhoneNumber = null,
        $DateOfBirth = null,
        $USER_NAME = null,
        $password = null,
        $privileges = null,
        $hours_contributed = null,
        $NumberOfEventsAttended = null,
        $badge_name = null,
        $country = null,
        $city = null,
        $area = null
    ) {

       
        if ($UserID != null) {
            $this->UserID = $UserID;
        }

        if ($VolunteerID != null) {
            $this->VolunteerID = $VolunteerID;
        }
        else{
            echo "user id is $UserID";
            $this->VolunteerID = $this->getVolunteerIdByUserId($UserID);
            
        }
        $volunteerData= $this->get_volunteer_by_id($this->VolunteerID);

        $this->hours_contributed = $hours_contributed?? $volunteerData->hours_contributed;
        $this->NumberOfEventsAttended = $NumberOfEventsAttended?? $volunteerData->NumberOfEventsAttended;
        $this->FirstName = $FirstName?? $volunteerData->FirstName;
        $this->LastName = $LastName?? $volunteerData->LastName;
        $this->Email = $Email?? $volunteerData->Email;
        $this->PhoneNumber = $PhoneNumber?? $volunteerData->PhoneNumber;
        if ($DateOfBirth != null && $DateOfBirth != 'undefined') {
            $this->DateOfBirth = $DateOfBirth;
        }
        else {
            $this->DateOfBirth = $volunteerData->DateOfBirth;
        }
        $this->USER_NAME = $USER_NAME?? $volunteerData->USER_NAME;
        $this->PASSWORD_HASH = $password !== null ? password_hash($password, PASSWORD_BCRYPT) : ($VolunteerID ? password_hash($password, PASSWORD_BCRYPT) :  $volunteerData->PASSWORD_HASH );

        $this->badge = $badge_name != null ? $this->get_badge_by_name($badge_name) : ($volunteerData->badge);
    
        $query = "UPDATE " . $this->table_name . " 
                  SET FirstName = ?, 
                      LastName = ?, 
                      Email = ?, 
                      PhoneNumber = ?, 
                      DateOfBirth = ?, 
                      USER_NAME = ?, 
                      PASSWORD_HASH = ?, 
                      hours_contributed = ?, 
                      NumberOfEventsAttended = ? ,
                      VolunteerBadgeID = ?
                  WHERE VolunteerID = ?";
    
        $stmt = $this->conn->prepare($query);
        $badge_id = $this->badge->getBadgeIdByName($this->badge->get_title());
        echo "badge name before getting badge id is . $badge_name";
        // $badge_id = $this->badge->badge_id;
        echo "now updating volunteer with values of hours contributed $hours_contributed and number of events attended $NumberOfEventsAttended and badge id $badge_id";

        $stmt->bind_param(
            "sssssssiiii",
            $this->FirstName,
            $this->LastName,
            $this->Email,
            $this->PhoneNumber,
            $this->DateOfBirth,
            $this->USER_NAME,
            $this->PASSWORD_HASH,
            $this->hours_contributed,
            $this->NumberOfEventsAttended,
            $badge_id,
            $this->VolunteerID
        );
        $status = $this->update_user(
            $this->UserID,
            $this->FirstName,
            $this->LastName,
            $this->Email,
            $this->PhoneNumber,
            $this->DateOfBirth,
            $this->USER_NAME,
            $this->PASSWORD_HASH,
            "volunteer",
            $privileges
        );
        if (!$stmt->execute()) {
            // echo "Error updating volunteer: " . $stmt->error . "<br>";
            return false;
        }
    
        if ($stmt->execute() && $status) {
            if ($country != null && $city != null && $area != null)
                {$this->updateLocation($this->UserID,$country, $city, $area); }
            return true;
        }
    
        return false;
    }
    
    

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        if (!$stmt->execute()) {
            // echo "Error deleting volunteer: " . $stmt->error;
            return false;
        }
        // call delete_user method from User class
        if (parent::delete($this->UserID)) {
            return $stmt->execute();
        }
        
    }

    public static function getAllVolunteers()
    {
        $sql = "SELECT * FROM Volunteer ORDER BY VolunteerID";
        $conn = Database::getInstance()->getConnection();
        $volunteerDataSet = $conn->query($sql);
        $i = 0;
        $Result = [];
        if ($volunteerDataSet === false) {
            // echo "Error in query execution: " . $conn->error;
            return [];
        }
        while ($row = mysqli_fetch_array($volunteerDataSet)) {
            $MyObj = new Volunteer($row["VolunteerID"]);
        
            $Result[$i] = $MyObj;
            $i++;
        }
        return $Result;
    }

    // public function add_skill($skill) {
    //     // this function takes a skill object as input
    //     $skill_id = $skill->SkillID;
    //     $skill_name = $skill->SkillName;
    //     $SkillLevel = $skill->SkillLevel;
    //     $SkillTypes = $skill->SkillTypes;

    //         $skill= Skill::create($skill_name, $SkillLevel, $SkillTypes);
        
       
    //         $skill_id = $skill->SkillID;
    
    //         // Insert the SkillID into the VolunteerSkills table
    //         $query = "INSERT INTO Volunteer_Skills (VolunteerID, SkillID) VALUES (?, ?)";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->bind_param("ii", $this->VolunteerID, $skill_id);
            
    //         if ($stmt->execute()) {
    //             return true;
    //         }
        
    //     return false;
    // }
    
    public function add_skill($skill)
    {
        // Assuming ISkillCommand is a class property
       $this->ISkillCommand = new AddSkill();
     // Create a new instance of AddSkill
        echo "volunteer id in add skill is $this->VolunteerID";
        $this->ISkillCommand->DO($skill,$this->VolunteerID); // Call the method, renamed to follow PHP conventions
    }

    public function get_skills() {
        // SQL query to fetch all skills associated with the volunteer
        $query = "
            SELECT s.SkillID, s.SkillName, s.SkillLevel 
            FROM Volunteer_Skills vs
            INNER JOIN Skill s ON vs.SkillID = s.SkillID
            WHERE vs.VolunteerID = ?
        ";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            // echo "Error preparing statement: " . $this->conn->error;
            return [];
        }
    
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
    
        
        $result = $stmt->get_result();
        $skills = [];
    
        // return skills as an array of skill objects
        while ($row = $result->fetch_assoc()) {
            $skill = new Skill();
            $skill->SkillID = $row['SkillID'];
            $skill->SkillName = $row['SkillName'];
            $skill->SkillLevel = $row['SkillLevel'];
            $skills[] = $skill;
        }
        
        $stmt->close();
        return $skills;
    }
    

    public function remove_skill($skillID) {
            // Delete the record from VolunteerSkills
            $query = "DELETE FROM Volunteer_Skills WHERE VolunteerID = ? AND SkillID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $this->VolunteerID, $skillID);
    
            if ($stmt->execute()) {
                return true;
            }
        
        return false;
    }

    // public function remove_skill($skillID)
    // {
    //     // Assuming ISkillCommand is a class property
    //    $this->ISkillCommand = new RemoveSkill();
    //  // Create a new instance of AddSkill
    //     echo "volunteer id in add skill is $this->VolunteerID";
    //     $this->ISkillCommand->DO($skillID,$this->VolunteerID); // Call the method, renamed to follow PHP conventions
    // }
    

    public function modify_skill($old_skill_name, $new_skill_name) {
        // Fetch SkillID for old skill
        $query = "SELECT SkillID FROM Skill WHERE SkillName = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $old_skill_name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $old_skill_id = $row['SkillID'];
    
            // Fetch SkillID for new skill
            $query = "SELECT SkillID FROM Skill WHERE SkillName = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $new_skill_name);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                $new_skill_id = $row['SkillID'];
    
                // Update the VolunteerSkills table
                $query = "UPDATE VolunteerSkills SET SkillID = ? WHERE VolunteerID = ? AND SkillID = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("iii", $new_skill_id, $this->VolunteerID, $old_skill_id);
    
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }
    

    public function add_history($volunteerHistory) {
      
        $query = "INSERT INTO Volunteer_VolunteerHistory (VolunteerID, HistoryID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $volunteerHistoryID = $volunteerHistory->getVolunteerHistoryID();
        $stmt->bind_param("ii", $this->VolunteerID, $volunteerHistoryID);
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    

    public function get_history() {
        $query = "
            SELECT vh.VolunteerHistoryID, vh.StartDate, vh.EndDate, vh.EventID
            FROM Volunteer_VolunteerHistory vvh
            INNER JOIN VolunteerHistory vh ON vvh.HistoryID = vh.VolunteerHistoryID
            WHERE vvh.VolunteerID = ?
        ";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return [];
        }
    
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $history = [];
    
        // return objects of VolunteerHistory
        while ($row = $result->fetch_assoc()) {
            $volunteerHistory = new VolunteerHistory();
            $volunteerHistory->VolunteerHistoryID = $row['VolunteerHistoryID'];
            $volunteerHistory->read_by_id($row['VolunteerHistoryID']);
            $history[] = $volunteerHistory;
    
        }
    
        $stmt->close();
    
        return $history;
    }
    
    



    public function remove_history($history_id) {
        // Delete from the linking table first
        $query = "DELETE FROM Volunteer_VolunteerHistory WHERE VolunteerID = ? AND HistoryID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->VolunteerID, $history_id);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    

    public function get_total_experience_years() {
        $totalYears = 0;
            $historyRecords = $this->get_history(); 
    
        foreach ($historyRecords as $history) {
            $startDate = new DateTime($history['StartDate']);
            $endDate = new DateTime($history['EndDate']);
            
            // Calculate the difference in years
            $interval = $startDate->diff($endDate);
            $years = $interval->y;  // Get the number of full years between StartDate and EndDate
            $totalYears += $years;
        }
    
        return $totalYears;
    }

    public function sort_history_by_date() {
        usort($this->volunteer_history, function($a, $b) {
            return strtotime($a->StartDate) - strtotime($b->StartDate);
        });
    }
    
    
    public function get_badge_by_name($badge_name) {
        $badge_name = trim($badge_name);
        // Step 1: Get the badge ID associated with the badge name
        $query = "SELECT badge_id FROM VolunteerBadge WHERE LOWER(title) = LOWER(?) LIMIT 1";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            // echo "Error preparing statement: " . $this->conn->error;
            return null;
        }
    
        $stmt->bind_param("s", $badge_name); // Bind the badge name parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $badge_id = $row['badge_id'] ?? null;
    
        // If no badge ID found, return null
        if (!$badge_id) {
            // echo "No badge found with the name: " . $badge_name;
            return null;
        }
    
        // Step 2: Retrieve the badge title from VolunteerBadge table
        $query = "SELECT title FROM VolunteerBadge WHERE badge_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            // echo "Error preparing statement: " . $this->conn->error;
            return null;
        }
    
        $stmt->bind_param("i", $badge_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $badge_title = $row['title'];
    
        if (!$badge_title) {
            echo "Badge title not found.";
            return null;
        }
    
        return BadgeFactory::createBadge($badge_name, $badge_id);
    }
    



    public function get_badge() {
        // Step 1: Get the badge ID associated with this volunteer
        $query = "SELECT VolunteerBadgeID FROM volunteer WHERE VolunteerID = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
     
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $badge_id = $row['VolunteerBadgeID'] ?? null;
        echo "badge id is $badge_id";
        if (!$badge_id) {
            echo "No badge assigned to this volunteer.";
            return null; // No badge assigned
        }
        $query = "SELECT title FROM VolunteerBadge WHERE badge_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $badge_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $badge_title = $row['title'];
        if (!$row) {
            return null; // Badge not found
        }
        echo "now getting badge with title $badge_title and id $badge_id";
        return BadgeFactory::createBadge($badge_title, $badge_id);
    }
    


    

    public function Update_badge($badge_name) {
   
        $badgeId = $this->getBadgeIDfromName($badge_name);
        $query = "UPDATE Volunteer SET VolunteerBadgeID = ? WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $badgeId, $this->VolunteerID);
        if ($stmt->execute()) {
            return true;
        }
        echo "Error updating badge: " . $stmt->error;
        return false;
    }

      public function getBadgeIDfromName($badge_name) {
        $conn = $this->conn;
        
        $query = "SELECT badge_id FROM VolunteerBadge WHERE title = ?";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param('s', $badge_name);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['badge_id'];
            } else {
                // echo "Badge not found";
                return null;
            }
        } else {
            // echo "Error retrieving badge ID: " . $stmt->error;
            return null;
        }
    }


    public function hasBadge() {
        // Checks if the volunteer has a badge assigned
        $query = "SELECT badge_id FROM " . $this->table_name . " WHERE VolunteerID = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $badge_id = $result->fetch_assoc()['badge_id'];
    
        return !empty($badge_id);
    }
    
    public function removeBadge() {
        $query = "UPDATE " . $this->table_name . " SET badge_id = NULL WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        
        if ($stmt->execute()) {
            $this->badge = null; 
            return true;
        }
        return false;
    }
    
    public function getBadgeDetails() {
        $query = "SELECT badge_id FROM " . $this->table_name . " WHERE VolunteerID = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $badge_id = $result->fetch_assoc()['badge_id'];
    
        if ($badge_id) {
            $query = "SELECT badge_name, badge_description FROM VolunteerBadge WHERE badge_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $badge_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Returns badge details as an associative array
        }
        return null;
    }
}
?>
