<?php
class VolunteerHistory 
{
    private $table = "VolunteerHistory";

    public $VolunteerHistoryID;
    public $StartDate;
    public $EndDate;
    private $conn;
    public $Event;  

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }

    public function create()
    {
        // Ensure that the Event reference is valid
        if ($this->Event instanceof Event) {
            $query = "INSERT INTO " . $this->table . " (StartDate, EndDate, EventID) VALUES (?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $this->StartDate, $this->EndDate, $this->Event->EventID);
            
            if ($stmt->execute()) {
                $this->VolunteerHistoryID = $this->conn->insert_id;
                return $this; // Return the current object with the updated ID
            } else {
                return null;
            }
        }

        return null; 
    }


    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        
        $volunteerHistories = [];
        while ($row = $result->fetch_assoc()) {
            $volunteerHistory = new VolunteerHistory($this->conn);
            $volunteerHistory->VolunteerHistoryID = $row['VolunteerHistoryID'];
            $volunteerHistory->StartDate = $row['StartDate'];
            $volunteerHistory->EndDate = $row['EndDate'];

            // Fetch the Event associated with this volunteer history
            $event = new Event($this->conn);
            $event->EventID = $row['EventID'];
            $volunteerHistory->Event = $event->read_by_id($row['EventID']);  // Get the Event details

            $volunteerHistories[] = $volunteerHistory;
        }

        return $volunteerHistories;
    }

    public function read_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE VolunteerHistoryID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $this->VolunteerHistoryID = $row['VolunteerHistoryID'];
            $this->StartDate = $row['StartDate'];
            $this->EndDate = $row['EndDate'];
            
            // Fetch the Event associated with this volunteer history
            $event = new Event($this->conn);
            $event->EventID = $row['EventID'];
            $this->Event = $event->read_by_id($row['EventID']);  // Get the Event details
            
            return $this;
        }

        return null;
    }

    public function update()
    {
        if ($this->Event instanceof Event) {
            $query = "UPDATE " . $this->table . " SET StartDate = ?, EndDate = ?, EventID = ? WHERE VolunteerHistoryID = ?";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssii", $this->StartDate, $this->EndDate, $this->Event->EventID, $this->VolunteerHistoryID);
            
            if ($stmt->execute()) {
                return $this;
            }
        }

        return null;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE VolunteerHistoryID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    public function get_event()
    {
        $event = new Event($this->conn);
        return $event->read_by_id($this->Event->EventID);
    }


    public function modify_event($newEvent)
    {
    if ($newEvent instanceof Event) {
        $query = "UPDATE " . $this->table . " SET EventID = ? WHERE VolunteerHistoryID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $newEvent->EventID, $this->VolunteerHistoryID);  // Use the EventID of the new Event

        if ($stmt->execute()) {
            $this->Event = $newEvent;
            return $this;  
        }
    }

    return null; 
    }

}
?>
