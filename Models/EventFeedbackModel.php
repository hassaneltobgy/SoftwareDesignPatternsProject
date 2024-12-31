<?php
require_once 'Database.php';
class EventFeedback {


private $FeedbackID;
private $Comments;
private $FeedbackDate;
private $Rating;

private $FeedbackTimestamp;
private $conn;


public function __construct($FeedbackID= null , $Comments= null, $FeedbackDate = null, $Rating = null , $Event = null, $FeedbackTimestamp= null)
{

    if ($this->FeedbackID != null) {
        $this->read_by_id($this->FeedbackID);
    }
    $this->FeedbackID = $FeedbackID;
    $this->Comments = $Comments;
    $this->FeedbackDate = $FeedbackDate;
    $this->Rating = $Rating;
    $this->FeedbackTimestamp = $FeedbackTimestamp;
    $this->conn = (Database::getInstance())->getConnection();




}


// getters and setters
public function getFeedbackID()
{
    return $this->FeedbackID;
}

public function setFeedbackID($FeedbackID)
{
    $this->FeedbackID = $FeedbackID;
}

public function getComments()
{
    return $this->Comments;
}

public function setComments($Comments)
{
    $this->Comments = $Comments;
}

public function getFeedbackDate()
{
    return $this->FeedbackDate;
}

public function setFeedbackDate($FeedbackDate)
{
    $this->FeedbackDate = $FeedbackDate;
}

public function getRating()
{
    return $this->Rating;
}

public function setRating($Rating)
{
    $this->Rating = $Rating;
}

public function getFeedbackTimestamp()
{
    return $this->FeedbackTimestamp;
}

public function setFeedbackTimestamp($FeedbackTimestamp)
{
    $this->FeedbackTimestamp = $FeedbackTimestamp;
}

public function create($EventID)
{
    $query = "INSERT INTO EventFeedback (Comments, FeedbackDate, Rating, EventID) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssii", $this->Comments, $this->FeedbackDate, $this->Rating, $EventID);
    if ($stmt->execute()) {
        $this->FeedbackID = $this->conn->insert_id;
        return $this;
    } else {
        return null;
    }

}

public function read_all()
{
    $query = "SELECT * FROM EventFeedback";
    $result = $this->conn->query($query);

    $eventFeedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $eventFeedback = new EventFeedback();
        $eventFeedback->FeedbackID = $row['FeedbackID'];
        $eventFeedback->Comments = $row['Comments'];
        $eventFeedback->FeedbackDate = $row['FeedbackDate'];
        $eventFeedback->Rating = $row['Rating'];

      
        $eventFeedbacks[] = $eventFeedback;
    }

    return $eventFeedbacks;

}


public function read_by_id($id)
{
    $query = "SELECT * FROM EventFeedback WHERE FeedbackID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $this->FeedbackID = $row['FeedbackID'];
        $this->Comments = $row['Comments'];
        $this->FeedbackDate = $row['FeedbackDate'];
        $this->Rating = $row['Rating'];

        return $this;
    }

    return null;
}




















}

?>