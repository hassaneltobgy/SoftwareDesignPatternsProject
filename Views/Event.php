<?php
require_once 'Database.php';
require_once 'LocationModel.php';
require_once 'OrganizationModel.php';

class Event 
{
    private $table = "Event";

    public $EventID;
    public $EventName;
    public $EventDate;
    public $EventDescription;
    private $conn;
    public $EventLocation;  
    public $EventTypes= [];
    public $EventFeedbacks= [];
    public $OrganizationName;

    public function __construct($id= null, $EventName= null, $EventDate= null, $EventLocation= null, $EventDescription= null, $OrganizationName= null)
    {
        $this->conn = (Database::getInstance())->getConnection();
        // get the event by id
        if ($id != null)
            $this->read_by_id($id);
        if ($EventName != null)
            $this->EventName = $EventName;
        if ($EventDate != null)
            $this->EventDate = $EventDate;
        if ($EventLocation != null)
            $this->EventLocation = $EventLocation;
        if ($EventDescription != null)
            $this->EventDescription = $EventDescription;
        if ($OrganizationName != null)
            $this->OrganizationName = $OrganizationName;
        
    }





    public static function create($EventName, $EventDate, $EventLocationID, $EventDescription, $OrganizationName)
    {
        $locationID = $EventLocationID;// when removing address it work as eventlocation is now the id
        $table = "Event";
        $event = new Event();
        $conn = (Database::getInstance())->getConnection();
    
        // Check if the event already exists
        $checkQuery = "SELECT EventID FROM " . $table . " WHERE EventName = ? AND EventDate = ? AND EventLocationID = ? AND EventDescription = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ssis", $EventName, $EventDate, $locationID, $EventDescription);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
    
        if ($checkResult->num_rows > 0) {
            // Event already exists, return null or the existing event details
            $existingEvent = $checkResult->fetch_assoc();
            $event->EventID = $existingEvent['EventID'];
            $event->EventName = $EventName;
            $event->EventDate = $EventDate;
            $event->EventLocation = $EventLocationID;
            $event->EventDescription = $EventDescription;
            $event->OrganizationName = $OrganizationName;
            Organization::addEvent($OrganizationName, $event->EventID);
    
            return $event; // Optionally return the existing event object
        }
    
        // If event does not exist, insert a new record
        $query = "INSERT INTO " . $table . " (EventName, EventDate, EventLocationID, EventDescription) 
                  VALUES (?, ?, ?, ?)";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssis", $EventName, $EventDate, $locationID, $EventDescription);
    
        if ($stmt->execute()) {

            $event->EventID = $conn->insert_id;
            $event->EventName = $EventName;
            $event->EventDate = $EventDate;
            $event->EventLocation = $EventLocationID;
            $event->EventDescription = $EventDescription;
            $event->OrganizationName = $OrganizationName;
            Organization::addEvent($OrganizationName, $event->EventID);
    
            return $event;
        } else {
            echo "Error: " . $stmt->error;
        }


        // i must insert the event id to table organization_event
        
    }
    


    public function getEventID()
    {
        return $this->EventID;
    }
    public function getEventName()
    {
        return $this->EventName;
    }
    public function getEventDescription()
    {
        return $this->EventDescription;
    }
    public function get_eventTypes()
    {
        $query = "SELECT EventTypeID FROM Event_EventType WHERE EventID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->EventID);
        $stmt->execute();

        $result = $stmt->get_result();
        $eventTypes = [];
        while ($row = $result->fetch_assoc()) {
            $eventType = new EventType();
            $eventType->setEventTypeID($row['EventTypeID']);
            $eventType = $eventType->read_by_id($row['EventTypeID']);
            $eventTypes[] = $eventType;
        }

        return $eventTypes;
    }

    public function get_organization_name()
    {
        $query = "SELECT OrganizationID from Organization_Event WHERE EventID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->EventID);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $organization = new Organization();
            $organization->set_organization_id($row['OrganizationID']);
            $organization = $organization->getOrganizationByID($row['OrganizationID']);
            return $organization->get_organization_name();
        }
        return null;

    }

    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);

        $events = [];
        while ($row = $result->fetch_assoc()) {
            $event = new Event();
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
        $id = intval($id);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->EventID = $row['EventID'];
            $this->EventName = $row['EventName'];
            $this->EventDate = $row['EventDate'];
            $this->EventDescription = $row['EventDescription'];
            $this->EventLocation = $this->get_location(); //  a location object
            $this->EventTypes = $this->get_eventTypes(); //array of event type objects
            $this->EventFeedbacks = $this->get_eventFeedbacks(); //array of event feedback objects
            $this->OrganizationName = $this->get_organization_name($this->EventID); // a string
            return $this;
        }

        return null;
    }

    public function get_eventFeedbacks()
    {
        // query the event feedback table by the event id to get the event feedbacks objects
        $query = "SELECT * FROM EventFeedback WHERE EventID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->EventID);
        $stmt->execute();

        $result = $stmt->get_result();
        $eventFeedbacks = [];
        while ($row = $result->fetch_assoc()) {
            $eventFeedback = new EventFeedback();
            $eventFeedback->setFeedbackID($row['FeedbackID']);
            $eventFeedback = $eventFeedback->read_by_id($row['FeedbackID']);
            $eventFeedbacks[] = $eventFeedback;
        }
    }

    public function update($EventName, $EventDate, $EventLocation, $EventDescription, $OrganizationName, $EventID)
    {
       $table = "Event";
        $conn = (Database::getInstance())->getConnection();
        $locationID = $EventLocation->LocationID; 

        $query = "UPDATE " . $table . " SET EventName = ?, EventDate = ?, EventLocationID = ?, EventDescription = ? 
                  WHERE EventID = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssisi", $EventName, $EventDate, $locationID, $EventDescription, $EventID);

        if ($stmt->execute()) {
            $OrganizationID= Organization::getOrganizationIDByName($OrganizationName);
            // update the organization id in the organization_event table
            $query = "UPDATE Organization_Event SET OrganizationID = ? WHERE EventID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $OrganizationID, $EventID);
            $stmt->execute();

           


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
    public function getLocationId($EventID) {
        $query = "SELECT EventLocationID FROM Event WHERE EventID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $EventID);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['EventLocationID'];
        }
    
        return null;
    }
    public function get_location() {
        $location = new Location();
        $locationID = $this->getLocationId($this->EventID);
        return $location->read_by_id($locationID);
    }


    public function getLocationDetails($EventID) {
        $locationId = $this->getLocationId($EventID);
    
        // Get the area name
        $locationName = Location::getLocationNameById($locationId);
    
        // Get the parent (city) of the area
        $cityName = Location::getParentFromChild($locationName);
    
        // Get the parent (country) of the city
        $countryName = Location::getParentFromChild($cityName);
    
        // Return the location as a formatted string
        return "{$countryName}, {$cityName}, {$locationName}";
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
    public function getEventIdByName($EventName) {
        $query = "SELECT EventID FROM Event WHERE EventName = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $EventName);
        $stmt->execute();
    
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['EventID'];
        }
    
        return null;
    }
}

?>
