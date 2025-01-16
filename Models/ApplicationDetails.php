<?php
class ApplicationDetails 
{
    private $table = "ApplicationDetails";

    public $ApplicationDetailsID;
    public $ApplicationDate;
    public $EventID;
    public $ApplicationStatusID;
    public $ApplyForEventID;
    private $conn;
     

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }


    public function createApplicationDetails( $applicationDate, $eventID, $applicationStatusID, $applyForEventID) {
        $sql = "INSERT INTO" . $this->table . "( ApplicationDate, EventID, ApplicationStatusID, ApplyForEventID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
         
        $stmt->bind_param("isii",  $applicationDate, $eventID, $applicationStatusID, $applyForEventID);
        if ($stmt->execute()) {
            $this->ApplicationDetailsID = $this->conn->insert_id;
            return true; // Creation successful
        } else {
            
            return NULL;
        }
        
    }

    //Submit Application that will create a new application record in the database and send a notification to the applicant
   public function submitApplication($applicationDate, $eventID, $applicationStatusID, $applyForEventID, $volunteerID) 
   {
        $applicationID= $this->createApplicationDetails($applicationDate, $eventID, $applicationStatusID, $applyForEventID);
        $volunteer = new Volunteer($volunteerID);
        $notificationService = new ApplicationSubmittedNotificationService([$volunteer]);
        // get notification types that the volunteer has 
        $NotificationTypes = User:: get_notification_types($volunteer->UserID);
        for ($i = 0; $i < count($NotificationTypes); $i++) {
            $observer = NotificationObserverFactory::createObserver($NotificationTypes[$i], $notificationService);

        }

        $notificationService->notify();
        
        
        $organization = Organization::GetOrganizationFromApplication($applicationID);
        $notifiicationServiceForOrganization = new ApplicationSubmittedfromVolunteerNotificationService(volunteerid:$volunteerID, Users: [$organization]);
        // get the notification types that the organization has 
        $NotificationTypes = User:: get_notification_types($organization->UserID);
        for ($i = 0; $i < count($NotificationTypes); $i++) {
            $observer = NotificationObserverFactory::createObserver($NotificationTypes[$i], $notifiicationServiceForOrganization);
        }
        
        $notifiicationServiceForOrganization->notify();
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

   

    public function updateApplicationDetails($applicationID, $applicationDate, $eventID, $applicationStatusID, $applyForEventID) {
        $sql = "UPDATE" . $this->table." SET ApplicationDate = ?, EventID = ?, ApplicationStatusID = ?, ApplyForEventID = ? WHERE ApplicationDetailsID = ?";
        $stmt = $this->conn->prepare($sql);
    
        
        $stmt->bind_param("iisii", $applicationDate, $eventID, $applicationStatusID, $applyForEventID, $applicationID);
    
        if ($stmt->execute()) {
            return true; // Update successful
        } else {
                
            return NULL;
        }
      
        
    }


    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE ApplicationDetailsID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();

    }
    public function getApplicationDetailsById($applicationDetailsID) {

        $query = "SELECT * FROM " . $this->table . " WHERE ApplicationDetailsID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $this->ApplicationDetailsID = $row['ApplicationDetailsID'];
            $this->ApplicationDate = $row['ApplicationDate'];
            $this->EventID = $row['EventID'];
            $this->ApplicationStatusID = $row['ApplicationStatusID'];
            $this->ApplyForEventID = $row['ApplyForEventID'];
            return $this;
        } else {
            // Handle not found error
            return null;
        }
 
    }


    public function getApplicationsByEvent($eventID) {
        $sql = "SELECT * FROM ". $this->table ." WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $eventID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $applications = [];
            while ($row = $result->fetch_assoc()) {
                $application = new ApplicationDetails($this->conn);
                $application->ApplicationDetailsID = $row['ApplicationDetailsID'];
                $application->ApplicationDate = $row['ApplicationDate'];
                $application->EventID = $row['EventID'];
                $application->ApplicationStatusID = $row['ApplicationStatusID'];
                $application->ApplyForEventID = $row['ApplyForEventID'];
                $applications[] = $application;
            }
    
            return $applications;
        } else {
            // Handle preparation errors
            return [];
        }
    }
    
    public function getApplicationsByStatus($applicationStatusID) {
        $sql = "SELECT * FROM ". $this->table . "WHERE ApplicationStatusID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $applicationStatusID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $applications = [];
            while ($row = $result->fetch_assoc()) {
                $application = new ApplicationDetails($this->conn);
                $application->ApplicationDetailsID = $row['ApplicationDetailsID'];
                $application->ApplicationDate = $row['ApplicationDate'];
                $application->EventID = $row['EventID'];
                $application->ApplicationStatusID = $row['ApplicationStatusID'];
                $application->ApplyForEventID = $row['ApplyForEventID'];
                $applications[] = $application;
            }
    
            return $applications;
        } else {
            // Handle preparation errors
            return [];
        }
    }
    
    

    public function linkApplicationToEvent($applicationID, $eventID) {
        $sql = "UPDATE ". $this->table . " SET ApplyForEventID = ? WHERE ApplicationDetailsID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("ii", $eventID, $applicationID);
            if ($stmt->execute()) {
                return true; // Link successful
            } else {
                // Handle execution errors
                echo "Error: " . $stmt->error;
                return false;
            }
        } else {
            // Handle preparation errors
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    public function updateApplicationStatus($applicationID, $applicationStatusID) {
        $sql = "UPDATE ". $this->table . " SET ApplicationStatusID = ? WHERE ApplicationDetailsID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("ii", $applicationStatusID, $applicationID);
            if ($stmt->execute()) {
                return true; // Update successful
            } else {
                // Handle execution errors
                echo "Error: " . $stmt->error;
                return false;
            }
        } else {
            // Handle preparation errors
            echo "Error: " . $this->conn->error;
            return false;
        }
    }
    public function getEventApplicationsSummary($eventID) {
        $sql = "SELECT COUNT(*) AS totalApplications, 
                       SUM(CASE WHEN ApplicationStatusID = 'approved' THEN 1 ELSE 0 END) AS approvedApplications,
                       SUM(CASE WHEN ApplicationStatusID = 'rejected' THEN 1 ELSE 0 END) AS rejectedApplications
                FROM ApplicationDetails
                WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $eventID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($row = $result->fetch_assoc()) {
                // Format and return the summary information
                return "Total Applications: " . $row['totalApplications'] . "\n" .
                       "Approved Applications: " . $row['approvedApplications'] . "\n" .
                       "Rejected Applications: " . $row['rejectedApplications'];
            } else {
                // Handle errors
                return "Error fetching summary";
            }
        } else {
            // Handle preparation errors
            return "Error preparing statement";
        }
    }
    public function setApplicationStatus($applicationDetailsID, $applicationStatusModel) {
        $sql = "UPDATE ". $this->table . " SET ApplicationStatusID = ? WHERE ApplicationDetailsID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $applicationStatusID = $applicationStatusModel->getApplicationStatusID(); // Assuming a getter method
            $stmt->bind_param("ii", $applicationStatusID, $applicationDetailsID);
            if ($stmt->execute()) {
                return true; // Update successful
            } else {
                // Handle execution errors
                echo "Error: " . $stmt->error;
                return false;
            }
        } else {
            // Handle preparation errors
            echo "Error: " . $this->conn->error;
            return false;
        }
    }


    

}
?>