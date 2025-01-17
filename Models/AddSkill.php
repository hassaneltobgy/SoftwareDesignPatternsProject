
<?php
require_once 'ISkillCommand.php';  
class AddSkill implements ISkillCommand
{
    private $VolunteerID;
    private $conn;
    private $skill_id;
  
      private  $skill_name ;
      private  $SkillLevel ;
       private $SkillTypes ;

    public function DO($skill,$VolunteerID,$conn)
    {
         // this function takes a skill object as input
        $skill_id = $skill->SkillID;
        $skill_name = $skill->SkillName;
        $SkillLevel = $skill->SkillLevel;
        $SkillTypes = $skill->SkillTypes;
        $VolunteerID = $VolunteerID;
        $conn=$conn;


            $skill= Skill::create($skill_name, $SkillLevel, $SkillTypes);
        
       
            $skill_id = $skill->SkillID;
    
            // Insert the SkillID into the VolunteerSkills table
            $query = "INSERT INTO Volunteer_Skills (VolunteerID, SkillID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $this->VolunteerID, $skill_id);
            
            if ($stmt->execute()) {
                return true;
            }
        
        return false;

    }

    public function UNDO()
    {
    }

}

?>
