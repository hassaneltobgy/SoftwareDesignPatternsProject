<?php
require_once 'Database.php';
class Privilege 
{
    public $PrivilegeID;
    public $PrivilegeName;
    public $Description;
    public $AccessLevel;
    private $conn;

    public function __construct($id= null) {
        $this->conn = Database::getInstance()->getConnection();
        $this->PrivilegeID = $id;
    }

    public function create($privilegeName, $description, $accessLevel) {
        $query = "INSERT INTO Privilege (PrivilegeName, Description, AccessLevel) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ssi', $privilegeName, $description, $accessLevel);

        return $stmt->execute();
    }

    // Method to read a Privilege by its ID
    public function read() {
        $query = "SELECT PrivilegeID, PrivilegeName, Description, AccessLevel FROM Privilege WHERE PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->PrivilegeID);

        // Execute query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->PrivilegeID = $row['PrivilegeID'];
            $this->PrivilegeName = $row['PrivilegeName'];
            $this->Description = $row['Description'];
            $this->AccessLevel = $row['AccessLevel'];
        }

        return $row ? true : false;
    }

    public function update($privilegeName, $description, $accessLevel) {
        $query = "UPDATE Privilege SET PrivilegeName = ?, Description = ?, AccessLevel = ? WHERE PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ssii', $privilegeName, $description, $accessLevel, $this->PrivilegeID);

        return $stmt->execute();
    }

    public function delete() {
        echo "deleting privilege with id: $this->PrivilegeID  ";
        $query = "DELETE FROM Privilege WHERE PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $this->PrivilegeID);

        if ($stmt->execute()){
            return true;
        } else {
            return $stmt->error;
        }
    }

    public static function getAllPrivileges() {
        $query = "SELECT PrivilegeID, PrivilegeName, Description, AccessLevel FROM Privilege";
        $result = Database::getInstance()->getConnection()->query($query);

        // return array of privilege objects
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
    public static function getPrivilegeNameByID($id) {
        $query = "SELECT PrivilegeName FROM Privilege WHERE PrivilegeID = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['PrivilegeName'];
    }
    public static function getPrivilegeIdByName($name) {
        echo "privilege name: $name";
        $query = "SELECT PrivilegeID FROM Privilege WHERE PrivilegeName = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);

        $stmt->bind_param('s', $name);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['PrivilegeID'];
    }

    
}
?>
