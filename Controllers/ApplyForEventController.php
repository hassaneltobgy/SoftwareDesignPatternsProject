<?php
require_once 'models/ApplyForEventModel.php';

class ApplyForEventController {
    private $model;

    public function __construct($db) {
        $this->model = new ApplyForEventModel($db);
    }

    // Create a new application for an event
    public function createApplication($applicationId, $applicationDate, $eventId, $applicationStatusId, $applyForEventId) {
        if ($this->model->createApplicationDetails($applicationId, $applicationDate, $eventId, $applicationStatusId, $applyForEventId)) {
            echo "Application created successfully!";
        } else {
            echo "Error creating application.";
        }
    }

    // Update an existing application details
    public function updateApplicationDetails($id) {
        if ($this->model->updateApplicationDetails($id)) {
            echo "Application updated successfully!";
        } else {
            echo "Error updating application.";
        }
    }

    // Delete an application details
    public function deleteApplicationDetails($id) {
        if ($this->model->deleteApplicationDetails($id)) {
            echo "Application deleted successfully!";
        } else {
            echo "Error deleting application.";
        }
    }

    // Get application details by ID
    public function getApplicationDetailsById($id) {
        $applicationDetails = $this->model->getApplicationDetailsById($id);
        include 'views/applyForEvent/view.php';
    }

    // Get applications by event
    public function getApplicationsByEvent($eventId) {
        $applications = $this->model->getApplicationsByEvent($eventId);
        include 'views/applyForEvent/list.php';
    }

    // Get applications by status
    public function getApplicationsByStatus($applicationStatusId) {
        $applications = $this->model->getApplicationsByStatus($applicationStatusId);
        include 'views/applyForEvent/list.php';
    }

    // Update application status
    public function updateApplicationStatus($id, $applicationStatusId) {
        if ($this->model->updateApplicationStatus($id, $applicationStatusId)) {
            echo "Application status updated successfully!";
        } else {
            echo "Error updating application status.";
        }
    }

    // Get event applications summary
    public function getEventApplicationsSummary($eventId) {
        $summary = $this->model->getEventApplicationsSummary($eventId);
        echo $summary;
    }

    // Set application status (using ApplicationStatus model)
    public function setApplicationStatus($applicationDetailsId, $applicationStatusModel) {
        if ($this->model->setApplicationStatus($applicationDetailsId, $applicationStatusModel)) {
            echo "Application status set successfully!";
        } else {
            echo "Error setting application status.";
        }
    }
}
?>
