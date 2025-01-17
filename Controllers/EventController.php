<?php 

require_once '../Models/Event.php';

class EventController
{
    private $EventModel;

    public function __construct()
    {
        $this->EventModel = new Event();
    }

    // Get all events
    public function getAllEvents()
    {
        echo "Getting all events...";
        return $this->EventModel->read_all();
    }

    // Get a single event by ID
    public function getEventById($id)
    {
        return $this->EventModel->read_by_id($id);
    }

    // Create a new event
    public function createEvent($EventName, $EventDate, $EventLocation, $EventDescription, $OrganizationName)
    {
        return $this->EventModel->create($EventName, $EventDate, $EventLocation, $EventDescription, $OrganizationName);
    }

    // Update an existing event
    public function updateEvent($EventName, $EventDate, $EventLocation, $EventDescription, $OrganizationName, $EventID)
    {
        return $this->EventModel->update($EventName, $EventDate, $EventLocation, $EventDescription, $OrganizationName, $EventID);
    }

    // Delete an event
    public function deleteEvent($EventID)
    {
        return $this->EventModel->delete($EventID);
    }
}



?>



