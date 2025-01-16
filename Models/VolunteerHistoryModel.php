<?php
class VolunteerHistory implements Iterator
{
    private $table = "VolunteerHistory";

    public $VolunteerHistoryID;
    public $StartDate;
    public $EndDate;
    private $conn;
    public $Event;  
    public $volunteerFeedbacks = [];

    private $position = 0;  // Iterator position
    private $volunteerHistories = [];  // This will hold all volunteer histories

    public function __construct($id = null)
    {
         $this->conn = (Database::getInstance())->getConnection();
        $this->VolunteerHistoryID = $id;
        if ($id != null) {
            $this->read_by_id($id);
        }
       
    }

    public static function create($StartDate, $EndDate, $Event)
    {
        $volunteerHistory = new VolunteerHistory();
        $table = "VolunteerHistory";
        $conn = (Database::getInstance())->getConnection();
    
        // Ensure that the Event reference is valid
        if ($Event instanceof Event) {
            // Check if the record already exists
            $checkQuery = "SELECT VolunteerHistoryID FROM " . $table . " WHERE StartDate = ? AND EndDate = ? AND EventID = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ssi", $StartDate, $EndDate, $Event->EventID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
    
            if ($checkResult->num_rows > 0) {
                // Record already exists, return the existing record
                $existingRecord = $checkResult->fetch_assoc();
                $volunteerHistory->VolunteerHistoryID = $existingRecord['VolunteerHistoryID'];
                $volunteerHistory->StartDate = $StartDate;
                $volunteerHistory->EndDate = $EndDate;
                $volunteerHistory->Event = $Event;
    
                return $volunteerHistory; // Return the existing record as an object
            }
    
            // If the record does not exist, insert a new one
            $query = "INSERT INTO " . $table . " (StartDate, EndDate, EventID) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $StartDate, $EndDate, $Event->EventID);
    
            if ($stmt->execute()) {
                $volunteerHistory->VolunteerHistoryID = $conn->insert_id;
                $volunteerHistory->StartDate = $StartDate;
                $volunteerHistory->EndDate = $EndDate;
                $volunteerHistory->Event = $Event;
    
                return $volunteerHistory; // Return the current object with the updated ID
            } else {
                return null; // Return null if the insertion fails
            }
        }
    
        return null; // Return null if the Event is not valid
    }
    
    public function getStartDate()
    {
        return $this->StartDate;
    }
    public function getEndDate()
    {
        return $this->EndDate;
    }
    public function getVolunteerHistoryID()
    {
        return $this->VolunteerHistoryID;
    }

    public function get_event()
    {
        $query = "SELECT EventID FROM " . $this->table . " WHERE VolunteerHistoryID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->VolunteerHistoryID);
        $stmt->execute();

        $result = $stmt->get_result();

        // return the event as object using read_by_id method
        if ($row = $result->fetch_assoc()) {
            $event = new Event();
            $event->EventID = $row['EventID'];
            $event=  $event->read_by_id($event->EventID);

        }

        return $event;

    }

    


    public function get_volunteerFeedbacks($VolunteerHistoryID)
    {
        // query table volunteerfeedback_volunteerhistory to get the feedbacks associated with this volunteer history
        $query = "SELECT FeedbackID FROM VolunteerFeedback_VolunteerHistory WHERE VolunteerHistoryID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $VolunteerHistoryID);
        $stmt->execute();

        $result = $stmt->get_result();
        $volunteerFeedbacks = [];
        while ($row = $result->fetch_assoc()) {
            $volunteerFeedback = new VolunteerFeedback();
            $volunteerFeedback->setFeedbackID($row['FeedbackID']);
            $volunteerFeedbacks[] = $volunteerFeedback->read_by_id($row['FeedbackID']);
        }
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
            $volunteerHistory->volunteerFeedbacks = $volunteerHistory->get_volunteerFeedbacks($row['VolunteerHistoryID']);

            // Fetch the Event associated with this volunteer history
            $event = new Event();
            $event->EventID = $row['EventID'];
            echo "now passing event id from read all: " . $event->EventID;
            $volunteerHistory->Event = $event->read_by_id($event->EventID);  // Get the Event details

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
            $event = new Event();
            $event->EventID = $row['EventID'];
            $this->Event = $event->read_by_id($event->EventID);  // Get the Event details
            
            return $this;
        }

        return null;
    }

    public function update($StartDate, $EndDate, $Event)
{
    echo "now updating volunteer history";
    $setParts = [];
    $params = [];
    $types = '';

    if ($StartDate !== null && $StartDate !== '') {
        $setParts[] = "StartDate = ?";
        $params[] = $StartDate;
        $types .= "s";  // s for string
    }

    if ($EndDate !== null && $EndDate !== '') {
        $setParts[] = "EndDate = ?";
        $params[] = $EndDate;
        $types .= "s";  // s for string
    }

    if ($Event !== null && $Event instanceof Event) {
        $setParts[] = "EventID = ?";
        $params[] = $Event->EventID;
        $types .= "i";  // i for integer
    }

    if (count($setParts) === 0) {
        return null;
    }

    $query = "UPDATE " . $this->table . " SET " . implode(", ", $setParts) . " WHERE VolunteerHistoryID = ?";

    // Add VolunteerHistoryID as the last parameter
    $params[] = $this->VolunteerHistoryID;
    $types .= "i";  // i for integer

    // Prepare and bind parameters
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param($types, ...$params); // Use spread operator to pass the params dynamically

    // Execute the query
    if ($stmt->execute()) {
 
        // Update the object with new values if needed
        if ($StartDate !== null) $this->StartDate = $StartDate;
        if ($EndDate !== null) $this->EndDate = $EndDate;
        if ($Event !== null) $this->Event = $Event;
        
        return $this;  // Return the updated object
    }

    echo "Error in updating VolunteerHistory: " . $stmt->error;
}


    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE VolunteerHistoryID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
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



    public function get_history_details($volunteerhistory)
    {
        for ($i = 0; $i < count($volunteerhistory); $i++) {
            $volunteerhistory[$i]->Event = $volunteerhistory[$i]->get_event();
        }


    }

    // iterator methods
    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->volunteerHistories[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }
   
    public function valid(): bool 
    {
        return isset($this->volunteerHistories[$this->position]);
    }

}
?>
