<?php
require_once 'ISkillCommand.php';  
require_once 'SkillsModel.php';
class RemoveSkill implements ISkillCommand
{
    private $VolunteerID;
    private $conn;


    public function DO($skillID, $VolunteerID)
    {
        
        $this->conn = Database::getInstance()->getConnection();
        $query = "DELETE FROM Volunteer_Skills WHERE VolunteerID = ? AND SkillID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $VolunteerID, $skillID);
    
            if ($stmt->execute()) {
                return true;
            }
        
        return false;

    }

    public function UNDO($skill,$VolunteerID)
    {
         // this function takes a skill object as input
         $skill_id = $skill->SkillID;
         $skill_name = $skill->SkillName;
         $SkillLevel = $skill->SkillLevel;
         $SkillTypes = $skill->SkillTypes;
         $VolunteerID = $VolunteerID;
         $this->conn = Database::getInstance()->getConnection();  
      
 
 
             $skill= Skill::create(  $skill_name,    $SkillLevel,   $SkillTypes);
         
        
             $skill_id = $skill->SkillID;
     
             // Insert the SkillID into the VolunteerSkills table
             $query = "INSERT INTO Volunteer_Skills (VolunteerID, SkillID) VALUES (?, ?)";
             $stmt = $this->conn->prepare($query);
             $stmt->bind_param("ii", $VolunteerID, $skill_id);
             
             if ($stmt->execute()) {
                 return true;
             }
             else {
                 echo "  Error: " . $stmt->error;
             }
         
         return false;
    }

}

?>