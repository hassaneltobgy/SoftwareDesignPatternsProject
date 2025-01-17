<?php
require_once '../Models/LocationModel.php';

class LocationController
{
    /**
     * Get all locations
     */
    public function getAllLocations()
    {
        $location = new Location();
        return $location->getAllLocations();
    }

    /**
     * Get location by ID
     */
    public function getLocationById($id)
    {
        $location = new Location();
        return $location->read_by_id($id);
    }

    /**
     * Add a new location (country, city, or area)
     */
    // public function addLocation($Name, $parentId = null)
    // {
    //     $location = Location::create(null, $Name, $parentId);
    //     if ($location) {
    //         return [
    //             'success' => true,
    //             'message' => 'Location added successfully.',
    //             'location' => $location
    //         ];
    //     }
    //     return [
    //         'success' => false,
    //         'message' => 'Failed to add location.'
    //     ];
    // }
    // public function create_location($Name)
    // {
    //     require_once 'C:\Users\HP\Downloads\SPD\Models\LocationModel.php';
    //     // Pass null for AddressID and ParentID, as they are optional
    //     return Location::create(null, $Name, null);
       
    
    // }
    public function create_location($Name, $ParentID = null)
{
    require_once 'C:\Users\HP\Downloads\SPD\Models\LocationModel.php';
    return Location::create(null, $Name, $ParentID);
}

    /**
     * Update an existing location
     */
    public function updateLocation($id, $Name, $parentId = null)
    {
        $location = new Location();
        $location->AddressID = $id;
        $location->Name = $Name;
        $location->ParentID = $parentId;

        if ($location->update()) {
            return [
                'success' => true,
                'message' => 'Location updated successfully.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Failed to update location.'
        ];
    }

    /**
     * Delete a location by ID
     */
    public function deleteLocation($id)
    {
        $location = new Location();
        $location->AddressID = $id;

        if ($location->delete()) {
            return [
                'success' => true,
                'message' => 'Location deleted successfully.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Failed to delete location.'
        ];
    }

    /**
     * Get child locations based on parent ID
     */
    public function getChildLocations($parentId)
    {
        $location = new Location(null, null, $parentId);
        return $location->getChildLocations();
    }

    /**
     * Get location ID by name
     */
    public function getLocationIdByName($Name)
    {
        return Location::getLocationID($Name);
    }

    /**
     * Get parent location name from child name
     */
    public function getParentFromChild($childName)
    {
        return Location::getParentFromChild($childName);
    }
}
?>
