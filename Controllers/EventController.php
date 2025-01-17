<?php
require_once 'C:\Users\HP\Downloads\SPD\Models\Event.php';
require_once 'C:\Users\HP\Downloads\SPD\Models\LocationModel.php';
require_once 'C:\Users\HP\Downloads\SPD\Models\OrganizationModel.php';
require_once 'C:\Users\HP\Downloads\SPD\Controllers\LocationController.php';
class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }

    // Get all events
    public function get_all_events() {
        return $this->eventModel->read_all();
    }
    
    
    // Add a new event
    public function add_event($data) {
        echo "Adding new event: " . $data['EventName'] . "\n";
    
        // Validate EventLocation
        if (empty($data['EventLocation'])) {
            echo "EventLocation is empty or null.\n";
            return false;
        }
    
        echo "Creating location with name: " . $data['EventLocation'] . "\n";
    
        $locationID = $data['EventLocationID']; // Root location, no parent
    
        // if (!$locationID) {
        //     echo "Failed to create location. Please check the inputs.\n";
        //     return false;
        // }
    
        echo "Location created with ID: " . $locationID . "\n";
    
        // Create the event
        $event = Event::create(
            $data['EventName'],
            $data['EventDate'],
            $locationID,
            $data['EventDescription'],
            $data['OrganizationName']
        );
    
        if ($event) {
            echo "Event added successfully.\n";
            return true;
        } else {
            echo "Failed to add event. Please check the inputs.\n";
            return false;
        }
    }
 
    //assign to org
    public static function createAndAssociateEvent($organizationName, $Data) {
        // Create the event
      
        if ($event) {
            $eventID = $event->getEventID()();
            // Associate the event with the organization
            return OrganizationModel::addEvent($organizationName, $eventID);
        }
    
        return false;
    }
    
    
    

    // Update an event
    public function update_event($data) {
        echo "Updating event with ID: " . $data['EventID'] . "\n";
    
        $event = new Event($data['EventID']);
        $eventLocation = Location::create($data['EventLocation']); // Directly create the location
    
        if (!$eventLocation) {
            echo "Failed to create location.\n";
            return false; // Return failure
        }
    
        $updatedEvent = $event->update(
            $data['EventName'],
            $data['EventDate'],
            $eventLocation,
            $data['EventDescription'],
            $data['OrganizationName'],
            $data['EventID']
        );
    
        if ($updatedEvent) {
            echo "Event updated successfully.\n";
            return true; // Return success
        } else {
            echo "Failed to update event.\n";
            return false; // Return failure
        }
    }
    

    // Delete an event
    public function delete_event($id) {
        echo "Deleting event with ID: $id\n";

        $event = new Event($id);
        if ($event->delete($id)) {
            echo "Event deleted successfully.\n";
        } else {
            echo "Failed to delete event.\n";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $eventController = new EventController();
    switch ($_POST['action']) {
        case 'addEvent':
            $data = [
                'EventName' => $_POST['EventName'],
                'EventDate' => $_POST['EventDate'],
                'EventLocation' => $_POST['EventLocation'],
                'EventDescription' => $_POST['EventDescription'],
                'OrganizationName' => $_POST['OrganizationName']
            ];
            $eventController->add_event($data);
            break;

        case 'updateEvent':
            $data = [
                'EventID' => $_POST['EventID'],
                'EventName' => $_POST['EventName'],
                'EventDate' => $_POST['EventDate'],
                'EventLocation' => $_POST['EventLocation'],
                'EventDescription' => $_POST['EventDescription'],
                'OrganizationName' => $_POST['OrganizationName']
            ];
            $eventController->update_event($data);
            break;

        case 'deleteEvent':
            $eventController->delete_event($_POST['EventID']);
            break;
    }
}
?>
