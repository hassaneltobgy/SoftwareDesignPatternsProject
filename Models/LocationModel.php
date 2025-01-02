<?php
require_once 'Database.php';
class Location
{
    public $AddressID;
    public $Name;
    public $ParentID;
    private $conn;

    public function __construct($AddressID= null, $Name = '', $ParentID = NULL) {
        $this->conn = Database::getInstance()->getConnection();
        $this->Name = $Name;
        $this->ParentID = $ParentID;
        $this->AddressID = $AddressID;
    }



    
    public static function create($AddressID= null, $Name= null, $ParentID= null)
    {
        $conn = Database::getInstance()->getConnection();
        if ($AddressID !== null) {
        // Check if the location already exists
        $checkQuery = "SELECT AddressID FROM Location WHERE AddressID = ? AND Name = ? AND ParentID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param('isi', $AddressID, $Name, $ParentID);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows > 0) {
        echo "Record already exists";
            // If a matching record is found, return the existing Location object
            $existingRecord = $checkResult->fetch_assoc();
            $location = new Location($AddressID, $Name, $ParentID);
            $location->AddressID = $existingRecord['AddressID'];
    
            return $location;
        }
    }
    
        // If no matching record exists, insert a new one
        echo "Now inserting in table Location, name is $Name, ParentID is $ParentID";
        $query = "INSERT INTO Location (Name, ParentID) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $Name, $ParentID);
    
        if ($stmt->execute()) {
            $location = new Location($conn->insert_id, $Name, $ParentID);
            // echo "Location created successfully $Name";
            return $location; // Return the new Location object
        }
        else {
            echo $stmt->error;
        }
    
        return null; // Return null if the insertion fails
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

        $stmt->bind_param('sii', $this->Name, $this->ParentID, $this->AddressID);

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
        // return $this->create();
    }

    public function addCity($Name, $ParentID)
    {
        $this->Name = $Name;
        $this->ParentID = $ParentID;
        // return $this->create();
    }
    public function addArea($Name, $ParentID)
    {
        $this->Name = $Name;
        $this->ParentID = $ParentID;
        // return $this->create();
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
        echo "Name is in getLocationID is " . $Name;
        $query = "SELECT AddressID FROM Location WHERE Name = ?";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $Name);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['AddressID']?? $stmt->error;
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

    public function read_by_id($id)
    {
        $query = "SELECT * FROM Location WHERE AddressID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->AddressID = $row['AddressID'];
            $this->Name = $row['Name'];
            $this->ParentID = $row['ParentID'];
            
            return $this;
        }

        return null;
    }
}
?>
