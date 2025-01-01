<?php
require_once 'Database.php';
require_once 'UserTypeModel.php';
require_once 'volunteerModel.php';
require_once 'LocationModel.php';
class User {
    private $conn;
    private $table_name = "User";
    public $UserID;
    public $FirstName;
    public $LastName;
    public $Email;
    public $PhoneNumber;
    public $DateOfBirth;
    public $USER_NAME;
    public $PASSWORD_HASH;
    public $LAST_LOGIN;
    public $ACCOUNT_CREATION_DATE;
    public $Privileges = []; 
    public $Locations = [];
    public $NotificationTypes = [];
    public $UserType;

    public function __construct($id = null) {
        $this->conn = Database::getInstance()->getConnection();
        $this->table_name = "User";
    
        if ($this->conn && !empty($id)) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE UserID = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                // Populate user properties
                $this->UserID = $row['UserID'];
                $this->FirstName = $row['FirstName'];
                $this->LastName = $row['LastName'];
                $this->Email = $row['Email'];
                $this->PhoneNumber = $row['PhoneNumber'];
                $this->DateOfBirth = $row['DateOfBirth'];
                $this->USER_NAME = $row['USER_NAME'];
                $this->PASSWORD_HASH = $row['PASSWORD_HASH'];
                $this->LAST_LOGIN = $row['LAST_LOGIN'];
                $this->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];

                $this->UserType = $this->getUserType();
                $this->Privileges = $this->getPrivileges();
                $this->Locations = $this->getLocations($this->UserID);
                $this->NotificationTypes = $this->get_notification_types($this->UserID);
            } else {
                // Handle case where no user is found
                echo "User not found.";
                return;  // Exit if the user is not found
            }
        }
    }
    
    

        static public function create( 
            $FirstName, 
            $LastName, 
            $Email, 
            $PhoneNumber, 
            $DateOfBirth, 
            $USER_NAME, 
            $PASSWORD_HASH, 
            $LAST_LOGIN, 
            $ACCOUNT_CREATION_DATE,
            $UserType ,
            $privileges = [],
        ) {
            
            
            $UserTypeID =User::getUserTypeIDByName(strtolower($UserType));
        
            if ($UserTypeID === null) {
                // echo "Error: UserType '$UserType' not found.";
                return null;
            }
        
            $user_new = new User();
            $user_new->FirstName = $FirstName;
            $user_new->LastName = $LastName;
            $user_new->Email = $Email;
            $user_new->PhoneNumber = $PhoneNumber;
            $user_new->DateOfBirth = $DateOfBirth;
            $user_new->USER_NAME = $USER_NAME;
            $user_new->PASSWORD_HASH = $PASSWORD_HASH;
            $user_new->LAST_LOGIN = $LAST_LOGIN;
            $user_new->ACCOUNT_CREATION_DATE = $ACCOUNT_CREATION_DATE;
            $user_new->UserType = $UserType;

            

            $query = "INSERT INTO " . $user_new->table_name . " 
                      (FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE, UserTypeID) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
            $conn = Database::getInstance()->getConnection();
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                echo "Prepare failed: " . $conn->error;
                return null;
            }

        
            $stmt->bind_param("sssssssssi", $FirstName, $LastName, $Email, $PhoneNumber, $DateOfBirth, $USER_NAME, $PASSWORD_HASH, $LAST_LOGIN, $ACCOUNT_CREATION_DATE, $UserTypeID);
        
            // Execute the query and return the new user
            if ($stmt->execute()) {
                echo "statement executed";
                $user_new->UserID = $conn->insert_id;
                if ($privileges === null) {
                    return $user_new;
                }
                for ($i = 0; $i < count($privileges); $i++) {
                    $privilege = $privileges[$i];
                    $user_new->addprivilege($privilege);
                }
                return $user_new;
            } else {
                echo "Error: " . $stmt->error;
                return null;
            }
        }
    public static function get_all_users(){
        $query = "SELECT * FROM User";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $user = new self();
            foreach ($row as $key => $value) {
                if (property_exists($user, $key)) {
                    $user->$key = $value;
                }
            }
            $user->UserType = $user->getUserType();
            $user->Privileges = $user->getPrivileges();
            $user->Locations = $user->getLocations($user->UserID);
            $users[] = $user;
        }
        return $users;
    }

    public static function get_by_email($email) {
        $query = "SELECT * FROM User WHERE Email = ? LIMIT 1";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $user = new self();
            foreach ($row as $key => $value) {
                if (property_exists($user, $key)) {
                    $user->$key = $value;
                }
            }
            $user->UserType = $user->getUserType();
            $user->Privileges = $user->getPrivileges();
            $user->Locations = $user->getLocations( $user->UserID);
            return $user;
        }
        return null;
    }
      
        
    public static function get_by_id($id) {
        $query = "SELECT * FROM User WHERE UserID = ? LIMIT 1";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $user = new self();
            foreach ($row as $key => $value) {
                if (property_exists($user, $key)) {
                    $user->$key = $value;
                }
            }
            $user->UserType = $user->getUserType();
            $user->Privileges = $user->getPrivileges();
            $user->Locations = $user->getLocations( $user->UserID);
            return $user;
        }
        return null;
    }

    public function getUserType() {
        // Query to get the UserType name based on the UserTypeID of the user with the given UserID
        $query = "SELECT UserTypeID FROM User WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        // get usertype from usertype id from table usertype
        if ($row = $result->fetch_assoc()) {
            $UserTypeID = $row['UserTypeID'];
            $query = "SELECT UserType FROM UserType WHERE UserTypeID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $UserTypeID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['UserType'];
            }
        }
        return null;


    }
    

    public static function getUserTypeIDByName($UserType) {
        echo"now in function getUserTypeIDByName and UserType is $UserType";
        $conn = Database::getInstance()->getConnection();
        $query = "SELECT UserTypeID FROM UserType WHERE UserType = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $UserType); // Bind the UserType name
        $stmt->execute();
        $result = $stmt->get_result();
    
        // If UserType exists, return the UserTypeID
        if ($row = $result->fetch_assoc()) {
            return $row['UserTypeID'];
        } else {
            // If UserType doesn't exist, return null or handle the error
            return null;
        }
    }
    public function getPrivileges() {
        if ($this->conn === null) {
            $this->conn = Database::getInstance()->getConnection();
        }
        $query = "SELECT p.* FROM Privilege p
                  JOIN User_Privilege up ON p.PrivilegeID = up.USER_PrivilegeID
                  WHERE up.User_ID = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            // echo "Prepare failed: " . $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $this->UserID);

        $stmt->execute();
        $result = $stmt->get_result();
        
        // create an array of privileges objects
        $privileges = [];
        while ($row = $result->fetch_assoc()) {
            $privilege = new Privilege();
            $privilege->PrivilegeID = $row['PrivilegeID'];
            $privilege->PrivilegeName = $row['PrivilegeName'];
            $privilege->Description = $row['Description'];
            $privilege->AccessLevel = $row['AccessLevel'];
            $privileges[] = $privilege;
        }
        return $privileges;
    }

    public function addprivilege($privilegeName) {
        $PrivilegeID = Privilege::getPrivilegeIdByName($privilegeName);
        echo "PrivilegeID: $PrivilegeID";
        echo "UserID: $this->UserID";
        $query = "INSERT INTO User_Privilege (User_ID,  User_PrivilegeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $PrivilegeID);
        
        return $stmt->execute();
    }

    public function removeprivilege($privilegeID) {
        $query = "DELETE FROM User_Privilege WHERE User_ID = ? AND  User_PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $privilegeID);

        return $stmt->execute();
    }

    public static function getLocationIds($UserId) {
        $query = "SELECT a.* FROM Location a
                  JOIN User_Address ua ON a.AddressID = ua.AddressID
                  WHERE ua.UserID = ?";

        $conn = Database::getInstance()->getConnection();
        if ($conn === null) {
            echo "Connection is null";
        }
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            echo "Prepare failed: " . $conn->error;
            return null;
        }
        $stmt->bind_param("i", $UserId);
        if ($stmt === false) {
            echo "Prepare failed: " . $conn->error;
            return null;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        // return location ids as an array
        $locationIds = [];
        while ($row = $result->fetch_assoc()) {
            $locationIds[] = $row['AddressID'];
        }
        
        return $locationIds;
    }

    public function getLocations($useriD) {
        $locationDictionary = [];
    
        $locationIds = $this->getLocationIds($useriD);
    
        for ($i = 0; $i < count($locationIds); $i++) {
            $locationName = Location::getLocationNameById($locationIds[$i]);
    
            // Get the parent (city) of the area
            $cityName = Location::getParentFromChild($locationName);
    
            // Get the parent (country) of the city
            $countryName = Location::getParentFromChild($cityName);
    
            // Create an array for the current location (with Area, City, Country)
            $location = [
                "ID" => $locationIds[$i],
                "Area" => $locationName,
                "City" => $cityName,
                "Country" => $countryName
            ];
    
            // Append the location to the locationDictionary array
            $locationDictionary[] = $location;
        }
    
        return $locationDictionary;
    }

    
    



    public function addLocation($AddressID, $UserID) {
        $this->conn = Database::getInstance()->getConnection();
        $query = "INSERT INTO User_Address (UserID, AddressID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $UserID, $AddressID);
        
        return $stmt->execute();
    }
    
    public static function removeLocation($AddressID, $userID) {
        echo "now removing location";
        $query = "DELETE FROM User_Address WHERE UserID = ? AND AddressID = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);

        $stmt->bind_param("ii", $userID, $AddressID);

        return $stmt->execute();
    }
    public function update_privilege($privilegeNames) {
    //    overwrite the priviliges for the user id 
    echo "now in update_privilege, updating privileges for user with ID: $this->UserID";
        $query = "DELETE FROM User_Privilege WHERE User_ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        // check if privilege names is not null 
        if ($privilegeNames === null) {
            return;
        }
        if (!is_array($privilegeNames)) {
            $privilegeNames = [$privilegeNames];
        }
        if (count($privilegeNames) === 0) {
            return;
        }
        for ($i = 0; $i < count($privilegeNames); $i++) {
            Privilege::getPrivilegeIdByName($privilegeNames[$i]);
            $this->addprivilege($privilegeNames[$i]);
        }
    }

    public function update_user(
        $UserID,
        $FirstName,
        $LastName,
        $Email,
        $PhoneNumber,
        $DateOfBirth,
        $USER_NAME,
        $PASSWORD_HASH,
        $userType = null,
        $privileges = null,   
        $locations =[]
    ) {
        echo("Updating user with ID: $UserID");
        echo ("UserType: $userType");

        $query = "UPDATE " . $this->table_name . " 
                  SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, DateOfBirth = ?, 
                      USER_NAME = ?, PASSWORD_HASH = ?, UserTypeID = ? 
                  WHERE UserID = ?";
        if ($this->conn === null) {
            $this->conn = Database::getInstance()->getConnection();
        }
        $this->UserID = $UserID;
        if ($privileges !== null) {
            echo "updating privileges";
            $this->update_privilege($privileges);
        }
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->PhoneNumber = $PhoneNumber;
        $this->DateOfBirth = $DateOfBirth;
        $this->USER_NAME = $USER_NAME;
        $this->PASSWORD_HASH = password_hash($PASSWORD_HASH, PASSWORD_BCRYPT);
        $this->UserType = $userType;
        $UserTypeID = User::getUserTypeIDByName($userType);
        
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssii", $FirstName, $LastName, $Email, $PhoneNumber, $DateOfBirth, $USER_NAME,$this->PASSWORD_HASH , $UserTypeID, $UserID);

        if ($stmt->execute()) {
            // echo "User updated successfully.";
            return $this;
        }
        else {
            // echo "Error: " . $stmt->error;
            return null;
        }
    }

    public  function updateLocation($userID, $country,$city,$area){
        echo "updating location";
        $locationCountryId= Location::getLocationID($country);
        $locationCityId= Location::getLocationID($city);
        $locationAreaId= Location::getLocationID($area);

        // first check if the country id is not null 
        if ($locationCountryId === null) {
            $location = new Location($country, null);
            $location->create($country, null);
            $locationCountryId = $location->AddressID;
        }
      
            // check if the city id is not null 
            if ($locationCityId === null) {
            $location = new Location($city, $locationCountryId);
            $location->create($city, $locationCountryId);   
            $locationCityId = $location->AddressID;
            }
            // else {
            //     $locationCityId = $location->AddressID;
            // }
         
         if ($locationAreaId === null) 
          { 
                echo "area id is null";
                    $location = new Location($area, $locationCityId);
                    $location->create($area, $locationCityId);
                    $locationAreaId = $location->AddressID;
                }

            // else{
            //         $locationAreaId = $location->AddressID;
            // }
            echo "locationAreaId is $locationAreaId";
            
        

        // add an entry in user_address table or update it  first check if the entry exists by checking the user id and address id
        $query = "SELECT * FROM User_Address WHERE UserID = ? AND AddressID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $userID, $locationAreaId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
        echo "Location exists";
            // update the entry
            $query = "UPDATE User_Address SET AddressID = ? WHERE UserID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $locationAreaId, $userID);
            $stmt->execute();
            if ($stmt->execute()) {
                echo "Location updated successfully.";
                return true;
            } else {
                echo "Error: " . $stmt->error;
                return false;
            }
        } else {
        echo "Location does not exist";
            // add the entry
            $query = "INSERT INTO User_Address (UserID, AddressID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $userID, $locationAreaId);
            $stmt->execute();
            if ($stmt->execute()) {
                echo "Location added successfully.";
                return true;
            } else {
                echo "Error: " . $stmt->error;
                return false;
            }
        }

    }
    public function delete() {

        $userType = $this->getUserType();
        if ($userType === "admin") {
            Admin::deletebyUserID($this->UserID);
        }
        else if ($userType === "volunteer") {
            Volunteer::deletebyUserID($this->UserID);
        }
        else if ($userType === "organization") {
            Organization::deletebyUserID($this->UserID);
        }
        $query = "DELETE FROM User_Privilege WHERE User_ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        // delete from user_address
        $query = "DELETE FROM User_Address WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        // delete from user_notificationtype
        $query = "DELETE FROM User_NotificationType WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        $query = "DELETE FROM " . $this->table_name . " WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        
        if ( $stmt->execute()){
            // delete from user_privilege
            
            
            return true;
        } else {
            // echo the error to know what went wrong
            echo "Error: " . $stmt->error;
        }
    }

    public function listUsers() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public static function get_by_email_and_password_hash($email, $password_hash) {
        $query = "SELECT * FROM User WHERE Email = ? AND PASSWORD_HASH = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $password_hash);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $user = new User();
            foreach ($row as $key => $value) {
                if (property_exists($user, $key)) {
                    $user->$key = $value;
                }
            }
            // $user->UserType = $user->getUserType();
            $user->Privileges = $user->getPrivileges();
            $user->Locations = $user->getLocations($user->UserID);
            return $user;
        }
        return null;
    }
    public static function get_notification_types($UserID) {
        $query = "SELECT nt.* FROM NotificationType nt
                  JOIN User_NotificationType un ON nt.NotificationTypeID = un.NotificationTypeID
                  WHERE un.UserID = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            // echo "Prepare failed: " . $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $notification_types = [];
        // return an array of notification types objects
        while ($row = $result->fetch_assoc()) {
            $notificationType = new NotificationType();
            $notificationType->NotificationTypeID = $row['NotificationTypeID'];
            $notificationType->TypeName = $row['TypeName'];
            $notification_types[] = $notificationType;
        }
        return $notification_types;
    }



    public function add_notification_type($NotificationTypeID) {
        echo "now in add_notification_type, adding Notification Type for user with ID: $this->UserID, NotificationTypeID: $NotificationTypeID";
        $query = "INSERT INTO User_NotificationType (UserID, NotificationTypeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bind_param("ii", $this->UserID, $NotificationTypeID);
    
        $result = $stmt->execute();
    
        if ($result) {
            $newNotificationType = new NotificationType(); 
            $newNotificationType->NotificationTypeID = $NotificationTypeID;

    
            $this->NotificationTypes[] = $newNotificationType;
            return $newNotificationType;
    
        } 
    
        return null;
    }
    
    public function remove_notification_type($NotificationTypeID) {
        $query = "DELETE FROM User_NotificationType WHERE UserID = ? AND NotificationTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $NotificationTypeID);

        return $stmt->execute();
    }


    public function update_Notification_Types($NotificationTypeNames) {
        //    overwrite the notification types for the user id 
        echo "now in update_Notification_Types, updating Notification Types for user with ID: $this->UserID, NotificationTypeNames: $NotificationTypeNames";
            $query = "DELETE FROM User_NotificationType WHERE UserID = ?";
            $stmt = $this->conn->prepare($query);
        
            $stmt->bind_param("i", $this->UserID);
            $stmt->execute();
            // check if Notification Type names is not null 
            if ($NotificationTypeNames === null) {
                return;
            }
            if (!is_array($NotificationTypeNames)) {
                $NotificationTypeNames = [$NotificationTypeNames];
            }
            if (count($NotificationTypeNames) === 0) {
                return;
            }
            // split the notification type names by comma

            $NotificationTypeNames = explode(",", $NotificationTypeNames[0]);
            for ($i = 0; $i < count($NotificationTypeNames); $i++) {
                // trim the notification type name 
                $NotificationTypeNames[$i] = trim($NotificationTypeNames[$i]);
                echo "NotificationTypeNames[$i]: $NotificationTypeNames[$i]";
                $NotificationID= NotificationType::getNotificationTypeIdByName($NotificationTypeNames[$i]);
                echo "NotificationID: $NotificationID";
                $this->add_notification_type($NotificationID);
            }
        }
}
?>
