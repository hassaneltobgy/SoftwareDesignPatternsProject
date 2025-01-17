<?php 

interface ISkillCommand {
    public function DO($skill,$VolunteerID,$conn);
    public function Undo();
}

?>
