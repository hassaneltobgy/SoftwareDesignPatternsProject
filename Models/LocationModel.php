<?php
require_once 'Database.php';
class Location
{
    public $AddressID;
    public $Name;
    public $ParentID;
    private $conn;

    public function __construct($Name = '', $ParentID = NULL) {
        $this->conn = Database::getInstance()->getConnection();
        $this->Name = $Name;
        $this->ParentID = $ParentID;
    }

    public function create() {
        $query = "INSERT INTO Location (Name, ParentID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $this->Name, $this->ParentID);

        // Execute query
        if ($stmt->execute()) {
            $this->AddressID = $this->conn->insert_id;
            return true;
        }
        else {
            echo "Error: " . $stmt->error;
        }
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

    public function addCountry($Name)
    {
        $this->Name = $Name;
        $this->ParentID = 0;
        return $this->create();
    }

    public function addCity($Name, $ParentID)
    {
        $this->Name = $Name;
        $this->ParentID = $ParentID;
        return $this->create();
    }
    public function addArea($Name, $ParentID)
    {
        $this->Name = $Name;
        $this->ParentID = $ParentID;
        return $this->create();
    }
    

    public function getAllCountries()
    {
        $query = "SELECT Name FROM Location WHERE ParentID = 0";
        $result = $this->conn->query($query);

        // Fetch all countries
        $countries = [];
        while ($row = $result->fetch_assoc()) {
            $countries[] = $row['Name'];
        }

        return $countries;
    }


    public function getAllCities()
    {
        $query = "SELECT Name FROM Location WHERE ParentID != 0";
        $result = $this->conn->query($query);

        // Fetch all cities
        // then query the parent id as an address id to check that its parent id is 0 because if so then it is a city
        $cities = [];
        while ($row = $result->fetch_assoc()) {
            $query = "SELECT ParentID FROM Location WHERE Name = ?";
            $stmt = $this->conn->prepare($query);

            $stmt->bind_param('s', $row['Name']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['ParentID'] == 0) {
                $cities[] = $row['Name'];
            }
        }
    }

    public function getAllAreas()
    {
        $query = "SELECT Name FROM Location WHERE ParentID != 0";
        $result = $this->conn->query($query);

        // Fetch all areas
        // then query the parent id as an address id to check that its parent id is not 0 because if so then it is an area
        $areas = [];
        while ($row = $result->fetch_assoc()) {
            $query = "SELECT ParentID FROM Location WHERE Name = ?";
            $stmt = $this->conn->prepare($query);

            $stmt->bind_param('s', $row['Name']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['ParentID'] != 0) {
                $areas[] = $row['Name'];
            }
        }
    }


    public static function getLocationNameById($AddressID)
    {
        $query = "SELECT Name FROM Location WHERE AddressID = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);

        $stmt->bind_param('i', $AddressID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['Name'];
    }


    public static function getParentFromChild($ChildName)
    {
        $query = "SELECT ParentID FROM Location WHERE Name = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $ChildName);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // get city name
        $query = "SELECT Name FROM Location WHERE AddressID = ?";
        $stmt = $conn->prepare($query);

        $stmt->bind_param('i', $row['ParentID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['Name'];    
    }


    public static function getLocationID($Name)
    {
        $query = "SELECT AddressID FROM Location WHERE Name = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $Name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['AddressID']?? null;
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
