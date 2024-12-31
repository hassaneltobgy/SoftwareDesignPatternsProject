<?php
require_once 'Database.php';

class VolunteerFeedback {


private $FeedbackID;
private $Comments;
private $FeedbackDate;
private $Rating;
private $FeedbackTimestamp;
private $conn;

// constructor
public function __construct($FeedbackID= null , $Comments= null, $FeedbackDate = null, $Rating = null , $FeedbackTimestamp= null)
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

public function create()
{
    $query = "INSERT INTO VolunteerFeedback (Comments, FeedbackDate, Rating, FeedbackTimestamp) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssis", $this->Comments, $this->FeedbackDate, $this->Rating, $this->FeedbackTimestamp);
    if ($stmt->execute()) {
        $this->FeedbackID = $this->conn->insert_id;
        return $this;
    } else {
        return null;
    }
}

public function read_all()
{
    $query = "SELECT * FROM VolunteerFeedback";
    $result = $this->conn->query($query);
    $volunteerFeedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $volunteerFeedback = new VolunteerFeedback();
        $volunteerFeedback->FeedbackID = $row['FeedbackID'];
        $volunteerFeedback->Comments = $row['Comments'];
        $volunteerFeedback->FeedbackDate = $row['FeedbackDate'];
        $volunteerFeedback->Rating = $row['Rating'];
        $volunteerFeedback->FeedbackTimestamp = $row['FeedbackTimestamp'];
        $volunteerFeedbacks[] = $volunteerFeedback;
    }
    return $volunteerFeedbacks;
}

public function read_by_id($id)
{
    $query = "SELECT * FROM VolunteerFeedback WHERE FeedbackID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $this->FeedbackID = $row['FeedbackID'];
        $this->Comments = $row['Comments'];
        $this->FeedbackDate = $row['FeedbackDate'];
        $this->Rating = $row['Rating'];
        $this->FeedbackTimestamp = $row['FeedbackTimestamp'];
        return $this;
    }
    return null;
}

public function update()
{
    $query = "UPDATE VolunteerFeedback SET Comments = ?, FeedbackDate = ?, Rating = ?, FeedbackTimestamp = ? WHERE FeedbackID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssisi", $this->Comments, $this->FeedbackDate, $this->Rating, $this->FeedbackTimestamp, $this->FeedbackID);
    return $stmt->execute();
}
}

?>
