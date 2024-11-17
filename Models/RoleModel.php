<?php
class RoleModel 
{
    private $table = "Role";

    public $RoleID;
    public $RoleName;
    public $RoleDescription;
    private $conn;

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (RoleDescription, RoleName, RoleID) VALUES (?, ?, ?)";
            
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->RoleDescription, $this->RoleName, $this->Event->RoleID);
            
        if ($stmt->execute()) {
            $this->RoleID = $this->conn->insert_id;
            return $this; // Return the current object with the updated ID
        } else {
            return null;
        }
        

        return null; 
    }


    public function getAllRoles()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        
        $Roless = [];
        while ($row = $result->fetch_assoc()) {
            $Role = new Role ($this->conn);
            $Role ->RoleID = $row['RoleID'];
            $Role ->RoleName = $row['RoleName'];
            $Role ->RoleDescription = $row['RoleDescription'];


            $Roles<> = $Role;
        }

        return $Roles;
    }

    
    public function addRoleToRequirement($requirementId, $roleId) {
            $sql = "INSERT INTO Requirement_Role (RequirementID, RoleID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $requirementId, $roleId);
    
            if ($stmt->execute()) {
                return true; // Success
            } else {
                return false; // Failure
            }
    }
    
    public function removeRoleFromRequirement($requirementId, $roleId) {
            $sql = "DELETE FROM Requirement_Role WHERE RequirementID = ? AND RoleID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $requirementId, $roleId);
    
            if ($stmt->execute()) {
                return true; // Success
            } else {
                return false; // Failure
            }
    }

    public function isRoleValid($roleId) {
        $sql = "SELECT COUNT(*) FROM " . $this->table . "WHERE RoleID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $roleId);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
    
            return $count > 0;
        } else {
            // Handle preparation errors
            return false;
        }
    }

    public function update()
    {
        
           $query = "UPDATE " . $this->table . " SET RoleName = ?, RoleDescription = ? WHERE RoleID = ?";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $this->RoleName, $this->RoleDescription,  $this->RoleID);
            
            if ($stmt->execute()) {
                return $this;
            }
        

        return null;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE RoleID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }


}
?>
