<?php
class OrganizationType {
    public $OrganizationTypeID;
    public $OrganizationType;
    private $conn;

   
    public function __construct($OrganizationTypeID)
    {
        $this->OrganizationTypeID = $OrganizationTypeID;
        $this->conn = Database::getInstance()->getConnection();
        // get organization type by ID
        $name = OrganizationType::get_organization_type_name_from_id($OrganizationTypeID);
        if ($name) {
            $this->OrganizationType = $name;
        }
    }

    // Method to create a new OrganizationType
    public function create() {
        $query = "INSERT INTO OrganizationType (OrganizationTypeName) VALUES (?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('s', $this->OrganizationType);

        // Execute query
        return $stmt->execute();
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
            $this->OrganizationType = $row['OrganizationTypeName'];
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE OrganizationType SET OrganizationType = ? WHERE OrganizationTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $this->OrganizationType, $this->OrganizationTypeID);

        // Execute query
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM OrganizationType WHERE OrganizationTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->OrganizationTypeID);

        // Execute query
        return $stmt->execute();
    }

    public function getAllOrganizationTypes() {
        $query = "SELECT OrganizationTypeID, OrganizationTypeName FROM OrganizationType";
        $result = $this->conn->query($query);

        // Fetch all user types as an associative array
        $OrganizationTypes = [];
        while ($row = $result->fetch_assoc()) {
            $OrganizationTypes[] = $row;
        }

        return $OrganizationTypes;
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
