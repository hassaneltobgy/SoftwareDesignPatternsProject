<?php
require_once "Database.php";
class Skill 
{
    private $table = "Skill";
    private $conn;
    public $SkillID;
    public $SkillName;
    public $SkillDescription;
    public $SkillLevel;
    public $SkillTypes = [];

    public function __construct($id = null)
    {
        $this->conn = (Database::getInstance())->getConnection();
        if ($id) {
            $skill = $this->read_by_id($id);
            $this->SkillID = $skill->SkillID;
            $this->SkillName = $skill->SkillName;
            $this->SkillDescription = $skill->SkillDescription;
            $this->SkillLevel = $skill->SkillLevel;
        }
    }
    public function create_skill($skillName, $skillDescription, $skillLevel)
    {
        $this->SkillName = $skillName;
        $this->SkillDescription = $skillDescription;
        $this->SkillLevel = $skillLevel;
        return $this->create();
    }

    
    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);
        
        $skills = [];
        while ($row = $result->fetch_assoc()) {
            $skill = new Skill($this->conn);
            $skill->SkillID = $row['SkillID'];
            $skill->SkillName = $row['SkillName'];
            $skill->SkillDescription = $row['SkillDescription'];
            $skill->SkillLevel = $row['SkillLevel'];
            $skills[] = $skill;
        }
        
        return $skills;
    }


    public function read_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE SkillID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $skill = new Skill($this->conn);
            $skill->SkillID = $row['SkillID'];
            $skill->SkillName = $row['SkillName'];
            $skill->SkillDescription = $row['SkillDescription'];
            $skill->SkillLevel = $row['SkillLevel'];
            return $skill;
        }
        
        return null; // No skill found
    }

     public function create()
     {
         $query = "INSERT INTO " . $this->table . " (SkillName, SkillDescription, SkillLevel) VALUES (?, ?, ?)";
         
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("sss", $this->SkillName, $this->SkillDescription, $this->SkillLevel);
 
         if ($stmt->execute()) {
             $this->SkillID = $this->conn->insert_id;
             return $this; // Return the current object with the updated ID
         } else {
             return null; 
         }
     }
 
     public function update()
     {
         $query = "UPDATE " . $this->table . " SET SkillName = ?, SkillDescription = ?, SkillLevel = ? WHERE SkillID = ?";
         
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("sssi", $this->SkillName, $this->SkillDescription, $this->SkillLevel, $this->SkillID);
         
         if ($stmt->execute()) {
             return $this; 
         } else {
             return null; 
         }
     }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE SkillID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    // Add a SkillType to this Skill
    public function add_skill_type($skillTypeID)
    {
        $query = "INSERT INTO SkillSkillType (SkillID, SkillTypeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->SkillID, $skillTypeID);
        if ($stmt->execute()) {
            return $this;
        }
        return null;
    }

    // Remove a SkillType from this Skill
    public function remove_skill_type($skillTypeID)
    {
        $query = "DELETE FROM SkillSkillType WHERE SkillID = ? AND SkillTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->SkillID, $skillTypeID);
        return $stmt->execute();
    }


    public function get_skill_types()
    {
        $query = "SELECT st.SkillTypeID, st.SkillTypeName FROM Skill_SkillType sst
                  INNER JOIN Skill_SkillType st ON sst.SkillTypeID = st.SkillTypeID
                  WHERE sst.SkillID = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->SkillID);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $skillTypes = [];
        
        while ($row = $result->fetch_assoc()) {
            $skillTypes[] = $row;
        }
        
        return $skillTypes;
    }
}
?>
