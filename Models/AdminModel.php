<?php
require_once '../Models/DBproxy.php';
class Admin extends User
{
private $AdminID;
private $table_name = "Admin";
private $conn;
private $dbProxy;

public function __construct($id = null)
{
    parent::__construct();
    $this->conn = Database::getInstance()->getConnection();
    $this->dbProxy = new DBproxy(true);

    if (!$this->conn) {
        echo "Database connection error.";
        return;
    } elseif (empty($id)) {
        return;
    } else {
        $sql = "SELECT * FROM $this->table_name WHERE AdminId = ?";
        $params = [$id];
        $result = $this->dbProxy->executeQuery($sql, $params);

        if ($result && $row = $result->fetch_assoc()) {
            // Initialize the parent (User) class with the UserID from the Admin record
            parent::__construct($row['UserID']);

            $this->AdminID = $row['AdminId'];
            $this->UserID = $row['UserID'];
        } else {
            echo "No admin found with ID: $id";
        }
    }
}



public static function deletebyUserID($UserID)
{
    $conn = Database::getInstance()->getConnection();
    $dbProxy = new DBproxy(true);

    $query = "DELETE FROM Admin WHERE UserID = ?";
    $params = [$UserID];

    if (!$dbProxy->executeQuery($query, $params)) {
        echo "Error deleting Admin with UserID: $UserID";
        return false;
    }

    return true;
}


static public function create_admin(
    $FirstName, 
    $LastName, 
    $Email, 
    $PhoneNumber= null, 
    $DateOfBirth= null, 
    $USER_NAME, 
    $password= null, 
    $LAST_LOGIN, 
    $ACCOUNT_CREATION_DATE , 
    $privileges = []
) {
    // Assuming the parent::create() method returns a user object with the UserID
    $userCreated = parent::create(
        $FirstName, 
        $LastName, 
        $Email, 
        $PhoneNumber, 
        $DateOfBirth, 
        $USER_NAME, 
        $password?password_hash($password, PASSWORD_BCRYPT): null,
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
        $admin->PASSWORD_HASH = $password?password_hash($password, PASSWORD_BCRYPT): null;

        // Query to insert admin details
        $query = "INSERT INTO " . $admin->table_name . " 
        (
            FirstName, LastName, Email, PhoneNumber, DateOfBirth, USER_NAME, PASSWORD_HASH, LAST_LOGIN, ACCOUNT_CREATION_DATE, UserID
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Call executeQuery instead of using prepare and execute directly
        $params = [
            $FirstName, 
            $LastName, 
            $Email, 
            $PhoneNumber, 
            $DateOfBirth, 
            $USER_NAME, 
            $admin->PASSWORD_HASH, 
            $LAST_LOGIN, 
            $ACCOUNT_CREATION_DATE, 
            $userCreated->UserID
        ];
        $dbProxy = new DBproxy(true);
        // Use the executeQuery method to run the query
        if ($dbProxy->executeQuery($query, $params)) {
            $admin->AdminID = $admin->conn->insert_id;
            echo "Admin created successfully.";
            return $admin;
        } else {
            echo "Admin creation failed.";
        }
    } else {
        echo "User creation failed.";
    }
}


public function update(
    $UserID = null,
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
    echo "Updating admin!!";

    if ($AdminID != null) {
        $this->AdminID = $AdminID;
    } else {
        echo "User ID is $UserID ";
        $this->AdminID = $this->getAdminIDByUserId($UserID);
        echo "Admin ID is $this->AdminID ";
        $AdminData = $this->get_admin_by_id($this->AdminID);
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

    // Parameters for the query
    $params = [
        $this->FirstName,
        $this->LastName,
        $this->Email,
        $this->PhoneNumber,
        $this->DateOfBirth,
        $this->USER_NAME,
        $this->PASSWORD_HASH,
        $UserID,
        $this->AdminID,
    ];

    // Use dbProxy to execute the query
    if (!$this->dbProxy->executeQuery($query, $params)) {
        echo "Error updating admin.";
        return false;
    }

    echo "Now updating user from admin.";
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

    if (!$status) {
        echo "Error updating user.";
        return false;
    }

    return true;
}

        
public function get_admin_by_id($id)
{
    $sql = "SELECT * FROM $this->table_name WHERE AdminID = ?";
    $params = [$id];
    $result = $this->dbProxy->executeQuery($sql, $params);

    if ($result && $row = $result->fetch_assoc()) {
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

    return null;
}
public function getAdminIDByUserId($UserID)
{
    $sql = "SELECT AdminID FROM $this->table_name WHERE UserID = ?";
    $params = [$UserID];
    $result = $this->dbProxy->executeQuery($sql, $params);

    if ($result && $row = $result->fetch_assoc()) {
        return $row['AdminID'];
    } else {
        echo "No admin found with UserID: $UserID";
    }

    return null;
}
public function delete()
{
    $query = "DELETE FROM " . $this->table_name . " WHERE AdminID = ?";
    $params = [$this->AdminID];

    if (!$this->dbProxy->executeQuery($query, $params)) {
        return false;
    }

    // Call parent delete method to remove related user record
    if (parent::delete($this->UserID)) {
        return true;
    }

    return false;
}


}
?>