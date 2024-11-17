<?php
class Location extends Database
{
    public $AddressID;
    public $Name;
    public $ParentID;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create() {
        $query = "INSERT INTO Location (Name, ParentID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $this->Name, $this->ParentID);

        // Execute query
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT AddressID, Name, ParentID FROM Location WHERE AddressID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the AddressID
        $stmt->bind_param('i', $this->AddressID);

        // Execute query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->AddressID = $row['AddressID'];
            $this->Name = $row['Name'];
            $this->ParentID = $row['ParentID'];
        }

        return $row ? true : false;
    }

    public function update() {
        $query = "UPDATE Location SET Name = ?, ParentID = ? WHERE AddressID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('sii', $this->Name, $this->ParentID, $this->AddressID);

        // Execute query
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM Location WHERE AddressID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the AddressID
        $stmt->bind_param('i', $this->AddressID);

        // Execute query
        return $stmt->execute();
    }

    public function getAllLocations() {
        $query = "SELECT AddressID, Name, ParentID FROM Location";
        $result = $this->conn->query($query);

        // Fetch all locations
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row;
        }

        return $locations;
    }

    // Method to get child locations based on ParentID
    public function getChildLocations() {
        $query = "SELECT AddressID, Name, ParentID FROM Location WHERE ParentID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ParentID
        $stmt->bind_param('i', $this->ParentID);

        // Execute query
        $stmt->execute();

        // Fetch all child locations
        $result = $stmt->get_result();
        $childLocations = [];
        while ($row = $result->fetch_assoc()) {
            $childLocations[] = $row;
        }

        return $childLocations;
    }
}
?>
