
<?php
class EmergencyContact
{
    private $table = "EmergencyContact";

   
    public $EmergencyContactID;
    public $EmergencyContactName;
    private $conn;
    public $EmergencyContactPhone;  
    public $EmergencyContactRelation;

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }

    public function createEmergencyContact($name, $phone, $relation) {
        $sql = "INSERT INTO " . $this->table . " (EmergencyContactName, EmergencyContactPhone, EmergencyContactRelation) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $this->EmergencyContactName, $this->EmergencyContactPhone, $this->EmergencyContactRelation);
            if ($stmt->execute()) {
                $this->EmergencyContactID = $this->conn->insert_id;
                return true; // Creation successful
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

    public function updateEmergencyContact($id, $name, $phone, $relation) {
        $sql = "UPDATE " . $this->table . " SET EmergencyContactName = ?, EmergencyContactPhone = ?, EmergencyContactRelation = ? WHERE EmergencyContactID = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssi", $this->EmergencyContactName, $this->EmergencyContactPhone, $this->EmergencyContactRelation, $this->EmergencyContactID);
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

    public function removeEmergencyContact($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE EmergencyContactID = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $this->EmergencyContactID);
            if ($stmt->execute()) {
                return true; // Deletion successful
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
