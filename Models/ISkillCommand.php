<?php 

interface ISkillCommand {
    public function DO($skill,$VolunteerID);
    public function Undo($skill,$VolunteerID);
}

?>