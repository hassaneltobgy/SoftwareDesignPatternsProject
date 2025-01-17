<?php
class ApplyForEventModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new application details for an event
    public function createApplicationDetails($applicationId, $applicationDate, $eventId, $applicationStatusId, $applyForEventId) {
        $query = "INSERT INTO applicationdetails (applicationId, applicationDate, eventId, applicationStatusId, applyForEventId) 
                  VALUES (:applicationId, :applicationDate, :eventId, :applicationStatusId, :applyForEventId)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':applicationId', $applicationId);
        $stmt->bindParam(':applicationDate', $applicationDate);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->bindParam(':applicationStatusId', $applicationStatusId);
        $stmt->bindParam(':applyForEventId', $applyForEventId);
        
        return $stmt->execute();
    }

    // Update application details
    public function updateApplicationDetails($id) {
        $query = "UPDATE applicationdetails SET applicationDate = :applicationDate WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':applicationDate', date('Y-m-d H:i:s'));  // Update with current date for example
        return $stmt->execute();
    }

    // Delete an application details
    public function deleteApplicationDetails($id) {
        $query = "DELETE FROM applicationdetails WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Get application details by ID
    public function getApplicationDetailsById($id) {
        $query = "SELECT * FROM applicationdetails WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get applications by event
    public function getApplicationsByEvent($eventId) {
        $query = "SELECT * FROM applicationdetails WHERE eventId = :eventId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get applications by status
    public function getApplicationsByStatus($applicationStatusId) {
        $query = "SELECT * FROM applicationdetails WHERE applicationStatusId = :applicationStatusId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':applicationStatusId', $applicationStatusId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update the application status
    public function updateApplicationStatus($id, $applicationStatusId) {
        $query = "UPDATE applicationdetails SET applicationStatusId = :applicationStatusId WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':applicationStatusId', $applicationStatusId);
        return $stmt->execute();
    }

    // Get event application summary
    public function getEventApplicationsSummary($eventId) {
        $query = "SELECT COUNT(*) as totalApplications FROM applicationdetails WHERE eventId = :eventId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventId', $eventId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return "Total Applications for Event ID $eventId: " . $result['totalApplications'];
    }

    // Set the application status
    public function setApplicationStatus($applicationDetailsId, $applicationStatusModel) {
        $query = "UPDATE applicationdetails SET applicationStatusId = :applicationStatusId WHERE id = :applicationDetailsId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':applicationDetailsId', $applicationDetailsId);
        $stmt->bindParam(':applicationStatusId', $applicationStatusModel->getId());
        return $stmt->execute();
    }
}
?>
