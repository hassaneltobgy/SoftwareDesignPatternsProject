<?php
session_start();
require_once "C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Models\Database.php";
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Models\OrganizationModel.php';
require_once 'C:\Users\HP\Downloads\SDPPROJECT\SoftwareDesignPatternsProject\Models\Event.php';

class OrganizationController
{
    public function get_events_for_organization($OrganizationID)
    {
        return Organization::GetOrganizedEvents($OrganizationID); // Pass organization ID
    }
    public function get_organization_id_by_email($email) {
        // Use the Organization model to fetch the OrganizationID by email
        return Organization::GetOrganizationIDByEmail($email);
    }

    public function associate_event_with_organization($data)
    {
        echo "Associating event with organization...\n";
    
        // Step 1: Get EventID
        $eventName = $data["EventName"];
        if (!$eventName) {
            echo "Event not found.\n";
            return false;
        }


        $eventModel = new Event(); // Create an instance of the Event class
$eventId = $eventModel->getEventIdByName($eventName); // Call the method

        // Step 2: Get the OrganizationID using OrganizationModel
    $organizationID = $data['OrganizationID'] ?? null;
    if (!$organizationID) {
        echo "Organization name is missing.\n";
        return false;
    }
    $organizationName = Organization::getOrganizationNameByID($organizationID);
        // Step 2: Use the OrganizationModel to associate the event
        Organization::addEvent($organizationName, $eventId);
        return true;
    }
}

?>
