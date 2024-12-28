<?php
class Privilege 
{
    public $PrivilegeID;
    public $PrivilegeName;
    public $Description;
    public $AccessLevel;
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create() {
        $query = "INSERT INTO Privilege (PrivilegeName, Description, AccessLevel) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('ssi', $this->PrivilegeName, $this->Description, $this->AccessLevel);

        // Execute query
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

    public function update() {
        $query = "UPDATE Privilege SET PrivilegeName = ?, Description = ?, AccessLevel = ? WHERE PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ssii', $this->PrivilegeName, $this->Description, $this->AccessLevel, $this->PrivilegeID);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM Privilege WHERE PrivilegeID = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $this->PrivilegeID);

        return $stmt->execute();
    }

    public function getAllPrivileges() {
        $query = "SELECT PrivilegeID, PrivilegeName, Description, AccessLevel FROM Privilege";
        $result = $this->conn->query($query);

        $privileges = [];
        while ($row = $result->fetch_assoc()) {
            $privileges[] = $row;
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
