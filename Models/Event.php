<?php

class Event 
{
    private $table = "Event";

    public $EventID;
    public $EventName;
    public $EventDate;
    public $EventDescription;
    private $conn;
    public $EventLocation;  

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }

    public function create()
    {
        $locationID = $this->EventLocation->LocationID; 

        $query = "INSERT INTO " . $this->table . " (EventName, EventDate, EventLocationID, EventDescription) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $this->EventName, $this->EventDate, $locationID, $this->EventDescription);

        if ($stmt->execute()) {
            $this->EventID = $this->conn->insert_id;
            return $this; 
        } else {
            return null;
        }
    }

    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);

        $events = [];
        while ($row = $result->fetch_assoc()) {
            $event = new Event($this->conn);
            $event->EventID = $row['EventID'];
            $event->EventName = $row['EventName'];
            $event->EventDate = $row['EventDate'];
            $event->EventDescription = $row['EventDescription'];
            $event->EventLocation = $event->get_location(); 
            $events[] = $event;
        }

        return $events;
    }

    public function read_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE EventID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->EventID = $row['EventID'];
            $this->EventName = $row['EventName'];
            $this->EventDate = $row['EventDate'];
            $this->EventDescription = $row['EventDescription'];
            $this->EventLocation = $this->get_location(); 
            return $this;
        }

        return null;
    }

    public function update()
    {
       
        $locationID = $this->EventLocation->LocationID; 

        $query = "UPDATE " . $this->table . " SET EventName = ?, EventDate = ?, EventLocationID = ?, EventDescription = ? 
                  WHERE EventID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisi", $this->EventName, $this->EventDate, $locationID, $this->EventDescription, $this->EventID);

        if ($stmt->execute()) {
            return $this;
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE EventID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function get_location()
    {
        $query = "SELECT * FROM Location WHERE AddressID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->EventLocation->AddressID);  
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $location = new Location($this->conn);  
            $location->AddressID = $row['AddressID'];
            $location->Name = $row['Name']; 
            $location->ParentID = $row['ParentID'];
            return $location;
        }

        return null;  
    }
    public function modify_location($newLocation)
    {
        if ($newLocation instanceof Location) {
            $query = "UPDATE " . $this->table . " SET EventLocationID = ? WHERE EventID = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $newLocation->AddressID, $this->EventID);  

            if ($stmt->execute()) {
                // Update the EventLocation reference in the current object
                $this->EventLocation = $newLocation;
                return $this;  // Return the current object with the updated location
            }
        }

        return null;  // Return null if the location modification failed
    }
}

?>
