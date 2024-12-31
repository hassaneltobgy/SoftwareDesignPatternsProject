<?php
require_once 'Database.php';
class EventType{

private $EventTypeID;
private $EventTypeName;
private $conn;

public function __construct($EventTypeID= null , $EventTypeName= null)
{
    if ($this->EventTypeID != null) {
        $this->read_by_id($this->EventTypeID);
    }
    $this->EventTypeID = $EventTypeID;
    $this->EventTypeName = $EventTypeName;
    $this->conn = (Database::getInstance())->getConnection();

}
public function getEventTTypeID()
{
    return $this->EventTypeID;

}


public function setEventTypeID($EventTypeID)
{
    $this->EventTypeID = $EventTypeID;
}

public function getEventTypeName()
{
    return $this->EventTypeName;
}

public function setEventTypeName($EventTypeName)
{
    $this->EventTypeName = $EventTypeName;
}

public function create()
{
    $query = "INSERT INTO EventType (EventTypeName) VALUES (?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $this->EventTypeName);
    if ($stmt->execute()) {
        $this->EventTypeID = $this->conn->insert_id;
        return $this;
    } else {
        return null;
    }
}

public function read_all()
{
    $query = "SELECT * FROM EventType";
    $result = $this->conn->query($query);

    $eventTypes = [];
    while ($row = $result->fetch_assoc()) {
        $eventType = new EventType();
        $eventType->EventTypeID = $row['EventTypeID'];
        $eventType->EventTypeName = $row['EventTypeName'];
        $eventTypes[] = $eventType;
    }

    return $eventTypes;
}

public function read_by_id($id)
{
    $query = "SELECT * FROM EventType WHERE EventTypeID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $this->EventTypeID = $row['EventTypeID'];
        $this->EventTypeName = $row['EventTypeName'];
        return $this;
    }

    return null;
}
}

?>