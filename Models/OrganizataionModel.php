<?php
require_once 'UserModel.php'; 

class Organization extends User {
    public $OrganizationID;
    public $OrganizationName;
    public $OrganizationDescription;
    public $OrganizationEmail;
    public $OrganizationPhone;
    public $OrganizationAddressID;
    public $OrganizationTypeID;
    public $OrganizationWebsite;
    private $volunteers = [];
    private $events = [];
    private $organization = [];
    private $conn;
    private $table_name = "Orgaznization";

    public function __construct($id = null) {
        parent::__construct(); 
        $this->table_name = "Organization";
        $this->conn = Database::getInstance()->getConnection();
        if (!$this->conn) {
            echo "Database connection error.";
            return;
        } else if (empty($id)) {   
            echo "No ID for organization provided.";
            return;
        } else { 
            $sql = "SELECT * FROM $this->table_name WHERE OrganizationID = ?";
            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $this->OrganizationID = $row['OrganizationID'];
                $this->OrganizationName = $row['OrganizationName'];
                $this->OrganizationDescription = $row['OrganizationDescription'];
                $this->OrganizationEmail = $row['OrganizationEmail'];
                $this->OrganizationPhone = $row['OrganizationPhone'];
                $this->OrganizationAddressID = $row['OrganizationAddressID'];
                $this->OrganizationTypeID = $row['OrganizationTypeID'];
                $this->OrganizationWebsite = $row['OrganizationWebsite'];
            } else {
                echo "No organization found with ID: $id";
            }

            $stmt->close();
        }
    }

    static public function create_Organization(
        $OrganizationName, 
        $OrganizationDescription, 
        $OrganizationEmail, 
        $OrganizationPhone, 
        $OrganizationAddressID, 
        $OrganizationTypeID, 
        $OrganizationWebsite
    ) {
        $organization = new Organization();

        $query = "INSERT INTO " . $organization->table_name . " 
        (
            OrganizationName, OrganizationDescription, OrganizationEmail, 
            OrganizationPhone, OrganizationAddressID, OrganizationTypeID, OrganizationWebsite
        ) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $conn = Database::getInstance()->getConnection();
        if (!$conn) {
            echo "Database connection error.";
            return null;
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "ssssiss", 
            $OrganizationName, 
            $OrganizationDescription, 
            $OrganizationEmail, 
            $OrganizationPhone, 
            $OrganizationAddressID, 
            $OrganizationTypeID, 
            $OrganizationWebsite
        );

        if ($stmt->execute()) {
            $organization->OrganizationID = $conn->insert_id;
            $organization->OrganizationName = $OrganizationName;
            $organization->OrganizationDescription = $OrganizationDescription;
            $organization->OrganizationEmail = $OrganizationEmail;
            $organization->OrganizationPhone = $OrganizationPhone;
            $organization->OrganizationAddressID = $OrganizationAddressID;
            $organization->OrganizationTypeID = $OrganizationTypeID;
            $organization->OrganizationWebsite = $OrganizationWebsite;
            return $organization;
        } else {
            echo "Error creating organization: " . $stmt->error;
        }

        return null;
    }

    public function get_organization_by_id() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE OrganizationID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->OrganizationID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->OrganizationID = $row['OrganizationID'];
            $this->OrganizationName = $row['OrganizationName'];
            $this->OrganizationDescription = $row['OrganizationDescription'];
            $this->OrganizationEmail = $row['OrganizationEmail'];
            $this->OrganizationPhone = $row['OrganizationPhone'];
            $this->OrganizationAddressID = $row['OrganizationAddressID'];
            $this->OrganizationTypeID = $row['OrganizationTypeID'];
            $this->OrganizationWebsite = $row['OrganizationWebsite'];
            return $this;
        }

        return null;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET OrganizationName = ?, 
                      OrganizationDescription = ?, 
                      OrganizationEmail = ?, 
                      OrganizationPhone = ?, 
                      OrganizationAddressID = ?, 
                      OrganizationTypeID = ?, 
                      OrganizationWebsite = ? 
                  WHERE OrganizationID = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "ssssissi", 
            $this->OrganizationName, 
            $this->OrganizationDescription, 
            $this->OrganizationEmail, 
            $this->OrganizationPhone, 
            $this->OrganizationAddressID, 
            $this->OrganizationTypeID, 
            $this->OrganizationWebsite, 
            $this->OrganizationID
        );

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE OrganizationID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->OrganizationID);

        return $stmt->execute();
    }
//event management function 
public function OrganizeEvent($eventDetails)
{
    $query = "INSERT INTO Event (eventName, eventDescription, eventDate, organizationID) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
        "sssi",
        $eventDetails['eventName'],
        $eventDetails['eventDescription'],
        $eventDetails['eventDate'],
        $this->OrganizationID
    );

    return $stmt->execute();
}

public function RemoveEvent($eventID)
{
    $query = "DELETE FROM Event WHERE eventID = ? AND organizationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $eventID, $this->OrganizationID);

    return $stmt->execute();
}

public function ModifyEvent($eventID, $updatedDetails)
{
    $query = "UPDATE Event 
              SET eventName = ?, eventDescription = ?, eventDate = ? 
              WHERE eventID = ? AND organizationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
        "sssii",
        $updatedDetails['eventName'],
        $updatedDetails['eventDescription'],
        $updatedDetails['eventDate'],
        $eventID,
        $this->OrganizationID
    );

    return $stmt->execute();
}

public function GetOrganizedEvent()
{
    $query = "SELECT * FROM Event WHERE organizationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->OrganizationID);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    return $events;
}

public function GetDeletedEvent()
{
    // Assuming a `deleted_events` table is used for archived events
    $query = "SELECT * FROM DeletedEvents WHERE organizationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->OrganizationID);
    $stmt->execute();
    $result = $stmt->get_result();

    $deletedEvents = [];
    while ($row = $result->fetch_assoc()) {
        $deletedEvents[] = $row;
    }

    return $deletedEvents;
}
//volunteer application functions
public function AcceptApplication($applicationID)
{
    $query = "UPDATE VolunteerApplication SET status = 'Accepted' WHERE applicationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $applicationID);

    return $stmt->execute();
}

public function RejectApplication($applicationID)
{
    $query = "UPDATE VolunteerApplication SET status = 'Rejected' WHERE applicationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $applicationID);

    return $stmt->execute();
}

public function RemoveVolunteerApplication($applicationID)
{
    $query = "DELETE FROM VolunteerApplication WHERE applicationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $applicationID);

    return $stmt->execute();
}

public function ArchiveVolunteerApplication($applicationID)
{
    $query = "INSERT INTO ArchivedApplications SELECT * FROM VolunteerApplication WHERE applicationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $applicationID);

    if ($stmt->execute()) {
        $deleteQuery = "DELETE FROM VolunteerApplication WHERE applicationID = ?";
        $deleteStmt = $this->conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $applicationID);

        return $deleteStmt->execute();
    }

    return false;
}

public function CheckVolunteerApplication($applicationID)
{
    $query = "SELECT * FROM VolunteerApplication WHERE applicationID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $applicationID);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

}

?>