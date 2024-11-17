<?php
require_once "Database.php";
class SkillType 
{
    private $table = "SkillType";

    public $SkillTypeID;
    public $SkillTypeName;
    private $conn;

    public function __construct()
    {
        $this->conn = (Database::getInstance())->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (SkillTypeID, SkillTypeName) VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $this->SkillTypeID, $this->SkillTypeName);
        
        if ($stmt->execute()) {
            return $this;  
        }
        return null;
    }

    public function read_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE SkillTypeID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        
        if ($data) {
            $this->SkillTypeID = $data['SkillTypeID'];
            $this->SkillTypeName = $data['SkillTypeName'];
            return $this;  
        }
        return null;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET SkillTypeName = ? WHERE SkillTypeID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->SkillTypeName, $this->SkillTypeID);
        
        if ($stmt->execute()) {
            return $this;  
        }
        return null;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE SkillTypeID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->SkillTypeID);
        
        return $stmt->execute();
    }

    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        
        $skillTypes = [];
        while ($row = $result->fetch_assoc()) {
            $skillType = new SkillType($this->conn);
            $skillType->SkillTypeID = $row['SkillTypeID'];
            $skillType->SkillTypeName = $row['SkillTypeName'];
            $skillTypes[] = $skillType;  
        }
        
        return $skillTypes;  
    }
}
?>
