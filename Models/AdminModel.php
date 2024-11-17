<?php
require_once 'UserModel.php';

class Admin extends User {
    public $AdminId;
    public $FirstName;
    public $LastName;
    public $Email;
    public $PhoneNumber;
    public $DateOfBirth;
    public $USER_NAME;
    public $PASSWORD_HASH;
    public $LAST_LOGIN;
    public $ACCOUNT_CREATION_DATE;
    public $UserTypeID;
    private $conn;
    private $table_name = "Admin";

    public function __construct($id = null) {
        parent::__construct();
        $this->conn = Database::getInstance()->getConnection();
        if ($id) {
            $this->loadAdminById($id);
        }
    }

    // Load admin by ID
    private function loadAdminById($id) {
        $query = "SELECT * FROM $this->table_name WHERE AdminId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->AdminId = $row['AdminId'];
            $this->FirstName = $row['FirstName'];
            $this->LastName = $row['LastName'];
            $this->Email = $row['Email'];
            $this->PhoneNumber = $row['PhoneNumber'];
            $this->DateOfBirth = $row['DateOfBirth'];
            $this->USER_NAME = $row['USER_NAME'];
            $this->PASSWORD_HASH = $row['PASSWORD_HASH'];
            $this->LAST_LOGIN = $row['LAST_LOGIN'];
            $this->ACCOUNT_CREATION_DATE = $row['ACCOUNT_CREATION_DATE'];
            $this->UserTypeID = $row['UserTypeID'];
        }
        $stmt->close();
    }

    // Grant privilege to a user
    public function GrantPrivilege($userId, $privilege) {
        $query = "INSERT INTO GrantedPrivileges (UserID, Privilege) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $userId, $privilege);
        return $stmt->execute();
    }

    // Revoke privilege from a user
    public function RevokePrivilege($userId, $privilege) {
        $query = "DELETE FROM GrantedPrivileges WHERE UserID = ? AND Privilege = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $userId, $privilege);
        return $stmt->execute();
    }

    // Deactivate a user account
    public function DeactivateUserAccount($userId) {
        $query = "UPDATE User SET Active = 0 WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    // Update a user's type
    public function UpdateUserType($userId, $newType) {
        $query = "UPDATE User SET UserTypeID = ? WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $newType, $userId);
        return $stmt->execute();
    }

    // Add a new admin
    public static function addAdmin($FirstName, $LastName, $Email, $PhoneNumber, $USER_NAME, $PASSWORD_HASH, $UserTypeID) {
        $query = "INSERT INTO Admin (FirstName, LastName, Email, PhoneNumber, USER_NAME, PASSWORD_HASH, UserTypeID) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $FirstName, $LastName, $Email, $PhoneNumber, $USER_NAME, $PASSWORD_HASH, $UserTypeID);
        return $stmt->execute();
    }

    // Remove an admin
    public function removeAdmin($adminId) {
        $query = "DELETE FROM Admin WHERE AdminId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $adminId);
        return $stmt->execute();
    }

    // Update admin details
    public function UpdateAdmin() {
        $query = "UPDATE Admin SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, USER_NAME = ?, UserTypeID = ?
                  WHERE AdminId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "ssssssi",
            $this->FirstName,
            $this->LastName,
            $this->Email,
            $this->PhoneNumber,
            $this->USER_NAME,
            $this->UserTypeID,
            $this->AdminId
        );
        return $stmt->execute();
    }

    // Get all granted privileges of a user
    public function getGrantedPrivileges($userId) {
        $query = "SELECT * FROM GrantedPrivileges WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
