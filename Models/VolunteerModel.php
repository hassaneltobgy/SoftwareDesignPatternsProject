<?php
require_once 'UserModel.php';  
require_once 'BadgeDecorator.php';  
class Volunteer extends User {
    public $VolunteerID;   
    public $UserID; 
    public $hours_contributed;
    public $NumberOfEventsAttended;
    public $skills = [];  
    public $volunteer_history = [];  
    public $badge;  
    private $conn;
    private $table_name = "Volunteer";

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
            } else {
                echo "No volunteer found with ID: $id";
            }
    
            $stmt->close();
        }
    }
    

    static public function create_Volunteer(
        $FirstName, 
        $LastName, 
        $Email, 
        $PhoneNumber, 
        $DateOfBirth, 
        $USER_NAME, 
        $PASSWORD_HASH, 
        $LAST_LOGIN, 
        $ACCOUNT_CREATION_DATE , 
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
        $DateOfBirth, 
        $USER_NAME, 
        password_hash($PASSWORD_HASH, PASSWORD_BCRYPT), 
        $LAST_LOGIN, 
        $ACCOUNT_CREATION_DATE,
        "Volunteer"
        );  
      
        if ($userCreated) {
            $volunteer = new Volunteer();
    
            $query = "INSERT INTO " . $volunteer->table_name . " 
            (
                FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE,
                hours_contributed, NumberOfEventsAttended, VolunteerBadgeID, UserID
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
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
        $volunteer->PASSWORD_HASH = $PASSWORD_HASH;
        $volunteer->LAST_LOGIN = $LAST_LOGIN;
        $volunteer->ACCOUNT_CREATION_DATE = $ACCOUNT_CREATION_DATE;
        $volunteer->hours_contributed = $hours_contributed;
        $volunteer->NumberOfEventsAttended = $NumberOfEventsAttended;
        $volunteer->badge= $volunteer->get_badge_by_name($badge_name);
        

        $stmt->bind_param(
            "sssssssssiiii", 
            $FirstName, 
            $LastName, 
            $Email, 
            $PhoneNumber, 
            $DateOfBirth, 
            $USER_NAME, 
            password_hash($PASSWORD_HASH, PASSWORD_BCRYPT), 
            $LAST_LOGIN, 
            $ACCOUNT_CREATION_DATE, 
            $hours_contributed, 
            $NumberOfEventsAttended, 
            $badge_id,
            $UserId
        );
          
          
                
            if ($skills == []) {
                $skills = [];
            }
            if ($volunteer_history == []) 
            {
                $volunteer_history = [];
            }
            
            for ($i = 0; $i < count($skills); $i++) {
                $volunteer->add_skill($skills[$i]);
            }
            for ($i = 0; $i < count($volunteer_history); $i++) {
                $volunteer->add_history($volunteer_history[$i]);
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

    public function get_volunteer_by_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->VolunteerID = $row['VolunteerID'];
            $this->hours_contributed = $row['hours_contributed'];
            $this->NumberOfEventsAttended = $row['NumberOfEventsAttended'];
            $this->skills = $this->get_skills();
            $this->volunteer_history = $this->get_history();
            $this->badge = $this->get_badge();
            return $this;
        }

        return null;
    }

    public function update(
        $VolunteerID = null,
        $FirstName = null,
        $LastName = null,
        $Email = null,
        $PhoneNumber = null,
        $DateOfBirth = null,
        $USER_NAME = null,
        $PASSWORD_HASH = null,
        $hours_contributed = null,
        $NumberOfEventsAttended = null,
        $badge_name = null
    ) {
        if ($VolunteerID != null) {
            $this->VolunteerID = $VolunteerID;
        }
        if ($hours_contributed != null) {
            $this->hours_contributed = $hours_contributed;
            
        }
        if ($NumberOfEventsAttended != null) {
            $this->NumberOfEventsAttended = $NumberOfEventsAttended;
        }
        if ($FirstName != null) {
            $this->FirstName = $FirstName;
            
        }
        if ($LastName != null) {
            $this->LastName = $LastName;
                    }
        if ($Email != null) {
            $this->Email = $Email;
              }
        if ($PhoneNumber != null) {
            $this->PhoneNumber = $PhoneNumber;
       
        }
        if ($DateOfBirth != null && $DateOfBirth != 'undefined') {
            $this->DateOfBirth = $DateOfBirth;
        
        }
        if ($USER_NAME != null) {
            $this->USER_NAME = $USER_NAME;
            
        }
        if ($PASSWORD_HASH != null) {
            $this->PASSWORD_HASH = $PASSWORD_HASH;
       
        }
        if ($badge_name != null) {
            $this->badge = $this->get_badge_by_name($badge_name);
            
           
        }
    
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
        // query volunteer badge to get badge id
        $badge_id = VolunteerBadge::getBadgeIdByName($badge_name);

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
            $this->PASSWORD_HASH
        );
        if (!$stmt->execute()) {
            // echo "Error updating volunteer: " . $stmt->error . "<br>";
            return false;
        }
    
        if ($stmt->execute() && $status) {
            // echo "Volunteer and user updated successfully.";

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

    public static function SelectAllVolunteersInDB()
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

    public function add_skill($skill_name) {
        // Fetch SkillID for the given skill name
        $query = "SELECT SkillID FROM Skill WHERE SkillName = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $skill_name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $skill_id = $row['SkillID'];
    
            // Insert the SkillID into the VolunteerSkills table
            $query = "INSERT INTO VolunteerSkills (VolunteerID, SkillID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $this->VolunteerID, $skill_id);
            
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
    

    public function get_skills() {
        // SQL query to fetch all skills associated with the volunteer
        $query = "
            SELECT s.SkillID, s.SkillName, s.SkillDescription, s.SkillLevel 
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
    
        while ($row = $result->fetch_assoc()) {
            $skills[] = [
                'SkillID' => $row['SkillID'],
                'SkillName' => $row['SkillName'],
                'SkillDescription' => $row['SkillDescription'],
                'SkillLevel' => $row['SkillLevel']
            ];
        }
    
        $stmt->close();
    
        return $skills;
    }
    

    public function remove_skill($skill_name) {
        // Fetch SkillID for the given skill name
        $query = "SELECT SkillID FROM Skill WHERE SkillName = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $skill_name);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            $skill_id = $row['SkillID'];
    
            // Delete the record from VolunteerSkills
            $query = "DELETE FROM VolunteerSkills WHERE VolunteerID = ? AND SkillID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $this->VolunteerID, $skill_id);
    
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
    

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
    

    public function add_history(VolunteerHistory $volunteerHistory) {
        $start_date = $volunteerHistory->StartDate;
        $end_date = $volunteerHistory->EndDate;
        
        $event_id = $volunteerHistory->Event->EventID;
    
        $query = "INSERT INTO VolunteerHistory (StartDate, EndDate, EventID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $start_date, $end_date, $event_id);
    
        if ($stmt->execute()) {
            $history_id = $stmt->insert_id;
    
            $query = "INSERT INTO Volunteer_VolunteerHistory (VolunteerID, HistoryID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $this->VolunteerID, $history_id);
    
            if ($stmt->execute()) {
                return true;
            }
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
            // echo "Error preparing statement: " . $this->conn->error;
            return [];
        }
    
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $history = [];
    
        while ($row = $result->fetch_assoc()) {
            $history[] = [
                'VolunteerHistoryID' => $row['VolunteerHistoryID'],
                'StartDate' => $row['StartDate'],
                'EndDate' => $row['EndDate'],
                'EventID' => $row['EventID']
            ];
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
            // Now delete from the VolunteerHistory table
            $query = "DELETE FROM VolunteerHistory WHERE VolunteerHistoryID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $history_id);
    
            if ($stmt->execute()) {
                return true;
            }
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
    
        // Step 3: Create the base badge object (Start with a base badge)
        $baseBadge = new StarterBadgeDecorator($badge_id);
    
        // Apply decorators based on badge hierarchy
        switch ($badge_name) {
            case 'Leader Badge':
                return new LeaderBadgeDecorator(
                    new MasterBadgeDecorator(
                        new ExpertBadgeDecorator(
                            new AdvancedBadgeDecorator($baseBadge)
                        )
                    )
                );
            case 'Master Badge':
                return new MasterBadgeDecorator(
                    new ExpertBadgeDecorator(
                        new AdvancedBadgeDecorator($baseBadge)
                    )
                );
            case 'Expert Badge':
                return new ExpertBadgeDecorator(
                    new AdvancedBadgeDecorator($baseBadge)
                );
            case 'Advanced Badge':
                return new AdvancedBadgeDecorator($baseBadge);
            case 'Starter Badge':
                return $baseBadge;
            default:
                echo "No valid badge found for the name: " . $badge_name;
                return null;
        }
    }
    
    public function get_badge() {
        // Step 1: Get the badge ID associated with this volunteer
        $query = "SELECT VolunteerBadgeID FROM volunteer WHERE VolunteerID = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $this->VolunteerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $badge_id = $row['VolunteerBadgeID'] ?? null;
    
        if (!$badge_id) {
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
        $baseBadge = new StarterBadgeDecorator($badge_id);
        
        // Step 4: Apply decorators based on badge hierarchy
        switch ($badge_title) {
            case 'Leader Badge':
                return new LeaderBadgeDecorator(
                    new MasterBadgeDecorator(
                        new ExpertBadgeDecorator(
                            new AdvancedBadgeDecorator($baseBadge)
                        )
                    )
                );
            case 'Master Badge':
                return new MasterBadgeDecorator(
                    new ExpertBadgeDecorator(
                        new AdvancedBadgeDecorator($baseBadge)
                    )
                );
            case 'Expert Badge':
                return new ExpertBadgeDecorator(
                    new AdvancedBadgeDecorator($baseBadge)
                );
            case 'Advanced Badge':
                return new AdvancedBadgeDecorator($baseBadge);
            case 'Starter Badge':
                return $baseBadge;
            default:
                return null; // No valid badge found
        }
    }
    
    

    public function Update_badge($badge_name) {
        $query = "SELECT badge_id FROM VolunteerBadge WHERE badge_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $badge_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $badge_id = $result->fetch_assoc()['badge_id'];

        if (!$badge_id) {
            $query = "INSERT INTO VolunteerBadge (badge_name) VALUES (?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $badge_name);
            $stmt->execute();
            $badge_id = $this->conn->insert_id;
        }

        $query = "UPDATE " . $this->table_name . " SET badge_id = ? WHERE VolunteerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $badge_id, $this->VolunteerID);

        if ($stmt->execute()) {
            $this->badge = $badge_name;
            return true;
        }
        return false;
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
