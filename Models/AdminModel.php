<?php
class Admin extends User
{
private $AdminID;
private $table_name = "Admin";
private $conn;

public function __construct($id = null)
{
parent::__construct();
$this->conn = Database::getInstance()->getConnection();

if (!$this->conn) {
    echo "Database connection error.";
    return;
} else if (empty($id)) {
    return;
} else {
    $sql = "SELECT * FROM $this->table_name WHERE AdminId = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // First initialize the User class with the UserID from Volunteer record
        parent::__construct($row['UserID']);  // This initializes the parent (User) class

        // Now initialize the Volunteer class properties
        $this->AdminID = $row['AdminId'];
        $this->UserID = $row['UserID'];
        
    } else {
        echo "No volunteer found with ID: $id";
    }

    $stmt->close();
}
}


public static function deletebyUserID($UserID) {
    $conn = Database::getInstance()->getConnection();
    $query = "DELETE FROM Admin WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $UserID);
    if (!$stmt->execute()) {
         echo "Error deleting Admin: " . $stmt->error;
        return false;
    }
    return true;
}
static public function create_admin(
    $FirstName, 
    $LastName, 
    $Email, 
    $PhoneNumber, 
    $DateOfBirth, 
    $USER_NAME, 
    $password, 
    $LAST_LOGIN, 
    $ACCOUNT_CREATION_DATE , 
    $privileges = [],
)
{
    $userCreated = parent::create(
        $FirstName, 
        $LastName, 
        $Email, 
        $PhoneNumber, 
        $DateOfBirth, 
        $USER_NAME, 
        password_hash($password, PASSWORD_BCRYPT), 
        $LAST_LOGIN, 
        $ACCOUNT_CREATION_DATE,
        "admin",
        $privileges
        );  
        if ($userCreated) {
            echo "User created successfully.";
            $admin = new Admin();
            $admin->UserID = $userCreated->UserID;
            $admin->FirstName = $FirstName;
            $admin->LastName = $LastName;
            $admin->Email = $Email;
            $admin->PhoneNumber = $PhoneNumber;
            $admin->DateOfBirth = $DateOfBirth;
            $admin->USER_NAME = $USER_NAME;
            $admin->LAST_LOGIN = $LAST_LOGIN;
            $admin->ACCOUNT_CREATION_DATE = $ACCOUNT_CREATION_DATE;
            $admin->PASSWORD_HASH = password_hash($password, PASSWORD_BCRYPT);

            
            $query = "INSERT INTO " . $admin->table_name . " 
            (
                FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE, UserID
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $admin->conn->prepare($query);

            $stmt->bind_param("sssssssssi", $FirstName, $LastName, $Email, $PhoneNumber, $DateOfBirth, $USER_NAME, $admin->PASSWORD_HASH , $LAST_LOGIN, $ACCOUNT_CREATION_DATE, $userCreated->UserID);
            if ($stmt->execute()) {
                $admin->AdminID = $admin->conn->insert_id;
                echo "Admin created successfully.";
                return $admin;
            } 
            else {
                echo "Admin creation failed.";
            }
            $stmt->close();
        } else {
            echo "User creation failed.";

        }
        
        
        }


        public function update(
            $UserID= null,
            $AdminID = null,
            $FirstName = null,
            $LastName = null,
            $Email = null,
            $PhoneNumber = null,
            $DateOfBirth = null,
            $USER_NAME = null,
            $password = null,
            $privileges = []
            
        ) {
    
            echo "updating admin!!";
            
            
            if ($AdminID != null) {
                $this->AdminID = $AdminID;
            }
            else{
                echo "user id is $UserID ";
                $this->AdminID = $this->getAdminIDByUserId($UserID);
                echo "admin id is $this->AdminID ";
                $AdminData= $this->get_admin_by_id($this->AdminID);
            }
    
            
            $this->FirstName = $FirstName ?? $AdminData->FirstName;
            $this->LastName = $LastName ?? $AdminData->LastName;
            $this->Email = $Email ?? $AdminData->Email;
            $this->PhoneNumber = $PhoneNumber ?? $AdminData->PhoneNumber;
            $this->DateOfBirth = ($DateOfBirth != 'undefined') ? $DateOfBirth : $AdminData->DateOfBirth;
            $this->USER_NAME = $USER_NAME ?? $AdminData->USER_NAME;
            $this->PASSWORD_HASH = $password ? password_hash($password, PASSWORD_BCRYPT) : $AdminData->PASSWORD_HASH;
            $this->table_name = "Admin";
            $query = "UPDATE " . $this->table_name . " 
              SET FirstName = ?, 
                  LastName = ?, 
                  Email = ?, 
                  PhoneNumber = ?, 
                  DateOfBirth = ?, 
                  USER_NAME = ?, 
                  PASSWORD_HASH = ?, 
                  UserID = ?
              WHERE AdminID = ?";

                $stmt = $this->conn->prepare($query);
                if (!$stmt) {
                    die("SQL Error: " . $this->conn->error);
                }
                echo "AdminID: $this->AdminID  ";
                $stmt->bind_param(
                    "sssssssii",
                    $this->FirstName,
                    $this->LastName,
                    $this->Email,
                    $this->PhoneNumber,
                    $this->DateOfBirth,
                    $this->USER_NAME,
                    $this->PASSWORD_HASH,
                    $UserID,
                    $this->AdminID
                );
                echo "now updating admin   ";
            if (!$stmt->execute()) {
                echo "Error updating admin: " . $stmt->error . "<br>";
                return false;
            }

            echo "now updating user from admin";
            $status = $this->update_user(
                $UserID,
                $this->FirstName,
                $this->LastName,
                $this->Email,
                $this->PhoneNumber,
                $this->DateOfBirth,
                $this->USER_NAME,
                $this->PASSWORD_HASH,
                "admin",
                $privileges
            );
            if (!$stmt->execute()) {
                // echo "Error updating volunteer: " . $stmt->error . "<br>";
                return false;
            }
        
            if ($stmt->execute() && $status) {    
                return true;
            }
        
            return false;
        }
        
        public function get_admin_by_id($id)
        {
            $sql = "SELECT * FROM $this->table_name WHERE AdminID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($row = $result->fetch_assoc()) {
                $admin = new Admin();
                $admin->AdminID = $row['AdminId'];
                $admin->UserID = $row['UserID'];
                $admin->FirstName = $row['FirstName'];
                $admin->LastName = $row['LastName'];
                $admin->Email = $row['Email'];
                $admin->PhoneNumber = $row['PhoneNumber'];
                $admin->DateOfBirth = $row['DateOfBirth'];
                $admin->USER_NAME = $row['USER_NAME'];
                $admin->PASSWORD_HASH = $row['PASSWORD_HASH'];
                $admin->LAST_LOGIN = $row['LAST_LOGIN'];
                $admin->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];
                return $admin;
            } else {
                echo "No admin found with ID: $id";
            }
        
            $stmt->close();
        }

        public function getAdminIDByUserId($UserID)
        {
            $sql = "SELECT AdminID FROM $this->table_name WHERE UserID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $UserID);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($row = $result->fetch_assoc()) {
                return $row['AdminID'];
            } else {
                echo "No admin found with UserID: $UserID";
            }
        
            $stmt->close();
        }


        public function delete() {
            $query = "DELETE FROM " . $this->table_name . " WHERE AdminID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $this->AdminID);
            if (!$stmt->execute()) {
                return false;
            }
            if (parent::delete($this->UserID)) {
                return $stmt->execute();
            }
            
        }

}
?>