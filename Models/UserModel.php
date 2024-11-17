<?php
require_once 'Database.php';
require_once 'UserTypeModel.php';
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
                $this->Locations = $this->getLocations();
                $this->NotificationTypes = $this->get_notification_types();
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
            $UserType // Accept UserType as a name (e.g., 'Admin', 'Volunteer')
        ) {
            
        
            $UserTypeID =User::getUserTypeIDByName($UserType);
        
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

            $query = "INSERT INTO " . $user_new->table_name . " 
                      (FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE, UserTypeID) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
            $conn = Database::getInstance()->getConnection();
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                // echo "Prepare failed: " . $conn->error;
                return null;
            }

        
            // Bind the parameters for insertion
            $stmt->bind_param("sssssssssi", $FirstName, $LastName, $Email, $PhoneNumber, $DateOfBirth, $USER_NAME, $PASSWORD_HASH, $LAST_LOGIN, $ACCOUNT_CREATION_DATE, $UserTypeID);
        
            // Execute the query and return the new user
            if ($stmt->execute()) {
                $user_new->UserID = $conn->insert_id;
                return $user_new;
            } else {
                // echo "Error: " . $stmt->error;
                return null;
            }
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
            $user->Locations = $user->getLocations();
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
            $user->Locations = $user->getLocations();
            return $user;
        }
        return null;
    }

    public function getUserType() {
        // Query to get the UserTypeID based on the UserID
        $query = "SELECT UserTypeID FROM User WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // If a UserTypeID is found, fetch it and return the corresponding UserType object
        if ($row = $result->fetch_assoc()) {
            $userTypeID = $row['UserTypeID'];
    
            // Create a new UserType object and set its properties
            $userType = new UserType();
            $userType->UserTypeID = $userTypeID;
            $userType->read(); // This will populate the UserType object with its details
    
            return $userType;
        }
    
        // If no UserTypeID is found, return null or handle as needed
        return null;
    }
    

    public static function getUserTypeIDByName($UserType) {
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
        
        $privileges = [];
        while ($row = $result->fetch_assoc()) {
            $privileges[] = $row;
        }
        return $privileges;
    }

    public function addprivilege($privilegeID) {
        $query = "INSERT INTO User_Privileges (UserID, PrivilegeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $privilegeID);
        
        return $stmt->execute();
    }

    public function removeprivilege($privilegeID) {
        $query = "DELETE FROM User_Privileges WHERE UserID = ? AND PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $privilegeID);

        return $stmt->execute();
    }

    public function getLocations() {
        $query = "SELECT a.* FROM Location a
                  JOIN User_Address ua ON a.AddressID = ua.AddressID
                  WHERE ua.UserID = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            // echo "Prepare failed: " . $this->conn->error;
            return null;
        }
        
        
        $stmt->bind_param("i", $this->UserID);
        if ($stmt === false) {
            // echo "Prepare failed: " . $this->conn->error;
            return null;
        }
        $stmt->execute();
        $result = $stmt->get_result();
        
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row;
        }
        return $locations;
    }

    public function addLocation($AddressID) {
        $query = "INSERT INTO User_Locations (UserID, AddressID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $AddressID);
        
        return $stmt->execute();
    }
    
    public function removeLocation($AddressID) {
        $query = "DELETE FROM User_Locations WHERE UserID = ? AND AddressID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $AddressID);

        return $stmt->execute();
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
    ) {
        error_log("Updating user with ID: $UserID");

        $query = "UPDATE " . $this->table_name . " 
                  SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, DateOfBirth = ?, 
                      USER_NAME = ?, PASSWORD_HASH = ? 
                  WHERE UserID = ?";
        if ($this->conn === null) {
            $this->conn = Database::getInstance()->getConnection();
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssssi", $FirstName, $LastName, $Email, $PhoneNumber, $DateOfBirth, $USER_NAME, $PASSWORD_HASH, $UserID);

        if ($stmt->execute()) {
            // echo "User updated successfully.";
            return true;
        }
        else {
            // echo "Error: " . $stmt->error;
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->UserID);

        return $stmt->execute();
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
            $user->Locations = $user->getLocations();
            return $user;
        }
        return null;
    }
    public function get_notification_types() {
        $query = "SELECT nt.* FROM NotificationType nt
                  JOIN User_NotificationType un ON nt.NotificationTypeID = un.NotificationTypeID
                  WHERE un.UserID = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            // echo "Prepare failed: " . $this->conn->error;
            return null;
        }
        $stmt->bind_param("i", $this->UserID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $notification_types = [];
        while ($row = $result->fetch_assoc()) {
            $notification_types[] = $row;
        }
        return $notification_types;
    }
    public function add_notification_type($NotificationTypeID) {
        $query = "INSERT INTO User_NotificationTypes (UserID, NotificationTypeID) VALUES (?, ?)";
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
        $query = "DELETE FROM User_NotificationTypes WHERE UserID = ? AND NotificationTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->UserID, $NotificationTypeID);

        return $stmt->execute();
    }

}
?>
