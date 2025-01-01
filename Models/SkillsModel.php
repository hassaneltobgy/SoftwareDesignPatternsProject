<?php
require_once "Database.php";
class Skill 
{
    private $table = "Skill";
    private $conn;
    public $SkillID;
    public $SkillName;
    public $SkillLevel;
    public $SkillTypes = [];

    public function __construct($id = null, $SkillName = null, $SkillLevel = null, $SkillTypes = null)
    {
        $this->conn = (Database::getInstance())->getConnection();
        if ($id) {
            $skill = $this->read_by_id($id);
            $this->SkillID = $skill->SkillID;
            $this->SkillName = $skill->SkillName;
            $this->SkillLevel = $skill->SkillLevel;
        }
        else{
            $this->SkillID = $id;
            $this->SkillName = $SkillName;
            $this->SkillLevel = $SkillLevel;
            $this->SkillTypes = $SkillTypes;
        }
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
            $skill->SkillLevel = $row['SkillLevel'];
            return $skill;
        }
        
        return null; // No skill found
    }

    public static function create($SkillName, $SkillLevel, $SkillTypes)
{
    $conn = (Database::getInstance())->getConnection();
    
    // First, check if the skill already exists
    $checkQuery = "SELECT * FROM Skill WHERE SkillName = ? AND SkillLevel = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("si", $SkillName, $SkillLevel);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the skill exists, return null or an appropriate message
    if ($result->num_rows > 0) {
        // return an object with the attributes of the existing skill
        $data = $result->fetch_assoc();
        $skill = new Skill();
        $skill->SkillID = $data['SkillID'];
        $skill->SkillName = $data['SkillName'];
        $skill->SkillLevel = $data['SkillLevel'];
        $skill->SkillTypes = $SkillTypes;
        return $skill;
    }
    
    // If the skill doesn't exist, proceed to insert
    $query = "INSERT INTO Skill (SkillName, SkillLevel) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $SkillName, $SkillLevel);
    
    if ($stmt->execute()) {
        $skill = new Skill();
        $skill->SkillID = $conn->insert_id;
        $skill->SkillName = $SkillName;
        $skill->SkillLevel = $SkillLevel;
        $skill->SkillTypes = $SkillTypes;
        
        // Associate the skill with its types
        foreach ($SkillTypes as $skillType) {
            $SkillTypeID = SkillType::GetSkillTypeID($skillType->SkillTypeName);
            $skill->add_skill_type($SkillTypeID);
        }
        
        return $skill;  // Return the newly created skill
    } else {
        return null;  // Something went wrong with the insert
    }
}

 
     public function update()
     {
         $query = "UPDATE " . $this->table . " SET SkillName = ?, SkillLevel = ? WHERE SkillID = ?";
         
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("sssi", $this->SkillName, $this->SkillLevel, $this->SkillID);
         
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
        $query = "INSERT INTO Skill_SkillType (SkillID, SkillTypeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->SkillID, $skillTypeID);
        if ($stmt->execute()) {
            return true;
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
                  INNER JOIN SkillType st ON sst.SkillTypeID = st.SkillTypeID
                  WHERE sst.SkillID = ?";
        
        $stmt = $this->conn->prepare($query);
    
        // Check if the query preparation was successful
        if ($stmt === false) {
            die('Error preparing the SQL query: ' . $this->conn->error);
        }
    
        $stmt->bind_param("i", $this->SkillID);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $skillTypes = [];
        
        // Return an array of SkillType objects
        while ($row = $result->fetch_assoc()) {
            $skillType = new SkillType();
            $skillType->SkillTypeID = $row['SkillTypeID'];
            $skillType->SkillTypeName = $row['SkillTypeName'];
            $skillTypes[] = $skillType;
        }
        
        return $skillTypes;
    }
}
    
?>
