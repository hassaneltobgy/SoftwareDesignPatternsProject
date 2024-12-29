<?php
require_once 'Database.php';
class OrganizationType {
    public $OrganizationTypeID;
    public $OrganizationTypeName;
    private $conn;

   
    public function __construct($OrganizationTypeID= null)
    {
        $this->OrganizationTypeID = $OrganizationTypeID;
        $this->conn = Database::getInstance()->getConnection();
        $name = OrganizationType::get_organization_type_name_from_id($OrganizationTypeID);
        if ($name) {
            $this->OrganizationTypeName = $name;
        }
    }

    // Method to create a new OrganizationType
    public function create($organizationTypeName) {
        $query = "INSERT INTO OrganizationType (OrganizationTypeName) VALUES (?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('s', $organizationTypeName);

        // Execute query
        if($stmt->execute())
        {
            return true;
        }
        else{
            echo "Error: " . $stmt->error;
        }

    }

    public function read() {
        $query = "SELECT OrganizationTypeID, OrganizationTypeName FROM OrganizationType WHERE OrganizationTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->OrganizationTypeID);

        // Execute query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Set properties if a row is returned
        if ($row) {
            $this->OrganizationTypeID = $row['OrganizationTypeID'];
            $this->OrganizationTypeName = $row['OrganizationTypeName'];
            return true;
        }

        return false;
    }

    public function update($organizationTypeName) {
        echo "now updating OrganizationType with id: $this->OrganizationTypeID";
        $query = "UPDATE OrganizationType SET OrganizationTypeName = ? WHERE OrganizationTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $organizationTypeName, $this->OrganizationTypeID);

        if ($stmt->execute()) {
            return true;
        }
        echo "Error: " . $stmt->error;
    }

    public function delete() {
        $query = "DELETE FROM OrganizationType WHERE OrganizationTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->OrganizationTypeID);

        // Execute query
        if ($stmt->execute()) {

            return true;
        }
        echo "Error: " . $stmt->error;
    }

    public static function getAllOrganizationTypes() {
        $query = "SELECT OrganizationTypeID, OrganizationTypeName FROM OrganizationType";
        $result = Database::getInstance()->getConnection()->query($query);

        // Fetch all user types as an associative array of organization type objects
        $organizationTypes = [];
        while ($row = $result->fetch_assoc()) {
            $organizationType = new OrganizationType();
            $organizationType->OrganizationTypeID = $row['OrganizationTypeID'];
            $organizationType->OrganizationTypeName = $row['OrganizationTypeName'];
            $organizationTypes[] = $organizationType;
        }

        return $organizationTypes;

    }
    public static function get_organization_type_id_from_name($name)
    {
        $query = "SELECT OrganizationTypeID FROM OrganizationType WHERE OrganizationTypeName = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['OrganizationTypeID'];
        }
        return null;
    }
    public static function get_organization_type_name_from_id($id)
    {
        $sql = "SELECT OrganizationTypeName FROM OrganizationType WHERE OrganizationTypeID = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['OrganizationTypeName'];
        }
        return null;
    }
}
?>
