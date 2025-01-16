<?php
require_once 'Database.php';
require_once 'DBProxy.php';
class Privilege 
{
    public $PrivilegeID;
    public $PrivilegeName;
    public $Description;
    public $AccessLevel;
    private $conn;
    private $dbProxy;

    public function __construct($id= null) {
        $this->conn = Database::getInstance()->getConnection();
        $this->PrivilegeID = $id;
        $this->dbProxy = new DBProxy(true);
    }

    public function create($privilegeName, $description, $accessLevel)
    {
        $query = "INSERT INTO Privilege (PrivilegeName, Description, AccessLevel) VALUES (?, ?, ?)";
        $params = [$privilegeName, $description, $accessLevel];
    
        if ($this->dbProxy->executeQuery($query, $params)) {
            return true;
        } else {
            echo "Error creating privilege";
            return false;
        }
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

    public function update($privilegeName, $description, $accessLevel)
{
    $query = "UPDATE Privilege SET PrivilegeName = ?, Description = ?, AccessLevel = ? WHERE PrivilegeID = ?";
    $params = [$privilegeName, $description, $accessLevel, $this->PrivilegeID];

    if ($this->dbProxy->executeQuery($query, $params)) {
        return true;
    } else {
        echo "Error updating privilege with ID: $this->PrivilegeID";
        return false;
    }
}


public function delete()
{
    echo "Deleting privilege with ID: $this->PrivilegeID";
    $query = "DELETE FROM Privilege WHERE PrivilegeID = ?";
    $params = [$this->PrivilegeID];

    if ($this->dbProxy->executeQuery($query, $params)) {
        return true;
    } else {
        echo "Error deleting privilege with ID: $this->PrivilegeID";
        return false;
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
