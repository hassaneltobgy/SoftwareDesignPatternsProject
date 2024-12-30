<?php
require_once '../Models/PrivilegeModel.php';
abstract class VolunteerBadge
{
    public $privileges = []; 
    protected $score;
    protected $title;
    protected $tableName;
    protected $conn;
    public $badge_id;
    

    public function __construct($badge_id= null)
    {
        $this->conn = (Database::getInstance())->getConnection();
        $this->badge_id = $badge_id;
        $this-> tableName = "VolunteerBadge";

    }

    abstract public function calc_score(): float;
    abstract public function get_title(): string;

    public static function getBadgeIdByName($badge_name) {
        $conn = (Database::getInstance())->getConnection();
        
        $query = "SELECT badge_id FROM VolunteerBadge WHERE title = ?";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param('s', $badge_name);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['badge_id'];
            } else {
                // echo "Badge not found";
                return null;
            }
        } else {
            // echo "Error retrieving badge ID: " . $stmt->error;
            return null;
        }
    }
    

    public function get_privileges() {
        // this gets privileges of a badge , because each badge has a list of privileges
        $query = "SELECT p.PrivilegeID, p.PrivilegeName, p.Description, p.AccessLevel 
                  FROM Privilege p
                  INNER JOIN VolunteerBadge_Privilege bp ON p.PrivilegeID = bp.PrivilegeID
                  WHERE bp.VolunteerBadgeID = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $this->badge_id);

        $stmt->execute();
        
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $privilege = new Privilege($this->conn);
            $privilege->PrivilegeID = $row['PrivilegeID'];
            $privilege->PrivilegeName = $row['PrivilegeName'];
            $privilege->Description = $row['Description'];
            $privilege->AccessLevel = $row['AccessLevel'];
            $privileges[] = $privilege;
        }

        return $privileges;
    }
    public function add_privilege($privilege) {
        $query = "INSERT INTO VolunteerBadge_Privilege (VolunteerBadgeID, PrivilegeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $this->badge_id, $privilege->PrivilegeID);
    
        if ($stmt->execute()) {
            $this->privileges[] = $privilege;
            return  $privilege;
        }
        
        return null;
    }
    

    public function remove_privilege($privilege) 
    {
            $query = "DELETE FROM VolunteerBadge_Privilege WHERE VolunteerBadgeID = ? AND PrivilegeID = ?";
            $stmt = $this->conn->prepare($query);

            $stmt->bind_param('ii', $this->badge_id, $privilege->PrivilegeID);

            return $stmt->execute();
        }

public function modify_privilege_for_a_certain_badge($old_privilege, $new_privilege) {
    $this->remove_privilege($old_privilege);
    return $this->add_privilege($new_privilege);
}

   public function add_badge($score, $title) {
    $query = "INSERT INTO VolunteerBadge ( score, title) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('is', $score, $title);

    if ($stmt->execute()) {
        return true;
    }
    return false;
    
}
public function remove_badge() {
    $query = "DELETE FROM VolunteerBadge WHERE badge_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $this->badge_id);
    return $stmt->execute();
}
public function update_badge($score, $title) {
    $query = "UPDATE VolunteerBadge SET score = ?, title = ? WHERE badge_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('isi', $score, $title, $this->badge_id);
    return $stmt->execute();
}
public function get_badge_by_id($badge_id) {
    $query = "SELECT * FROM VolunteerBadge WHERE badge_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $badge_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $badge = new VolunteerBadge($this->conn);
        $badge->badge_id = $row['badge_id'];
        $badge->score = $row['score'];
        $badge->title = $row['title'];
        return $badge;
    } else {
        return null;
    }

}

public static function get_all_badges() {
    $query = "SELECT * FROM VolunteerBadge";
    
    $conn = (Database::getInstance())->getConnection();
    $result = $conn->query($query);
    $badges = [];
    
    while ($row = $result->fetch_assoc()) {
        // Directly use the badge_id as the key and the entire row as the value
        $badges[$row['badge_id']] = $row;
    }
    
    return $badges;
}




}

// Abstract Badge Decorator
abstract class BadgeDecorator extends VolunteerBadge
{
    protected VolunteerBadge $badge;

    public function __construct($badge_id)
    {
        parent::__construct($badge_id); // Use the parent's constructor to set up DB connection and badge_id
        // $this->badge = $badge;
        // $this->update_badge_in_db();
      

    }
   

    // Abstract method for calculating score
    abstract public function calc_score(): float;

    public function get_title(): string
    {
        return $this->badge->get_title();
    }

    public function get_privileges(): array
    {
        return array_merge($this->badge->get_privileges(), $this->privileges);
    }

    


}

// Now the decorators will inherit from BadgeDecorator
class StarterBadgeDecorator extends BadgeDecorator
{
    
    public function calc_score(): float
    {   
        $this->score = 10;
        return $this->score;
    }

    public function get_title(): string
    {
        $this->title = 'Starter Badge';
        return $this->title;
    }
}

class AdvancedBadgeDecorator extends BadgeDecorator
{
    public $ref;
    public function __construct($badge)
    {
       $this->ref = $badge;
    }
    public function calc_score(): float
    {
        $this->score = $this->badge->calc_score() + 20;
        return $this->score;

    }

    public function get_title(): string
    {
        $this->title = 'Advanced Badge';
        return $this->title;
    }
}

class ExpertBadgeDecorator extends BadgeDecorator  
{
    public $ref;
    public function __construct($badge)
    {
       $this->ref = $badge;
    }
    public function calc_score(): float
    {
        $this->score = $this->badge->calc_score() + 30;
        return $this->score;
    }

    public function get_title(): string
    {
        $this->title = 'Expert Badge';
        return $this->title;
    }
}

class MasterBadgeDecorator extends BadgeDecorator
{
    public $ref;
    public function __construct($badge)
    {
       $this->ref = $badge;
    }
    public function calc_score(): float
    {
        $this->score = $this->badge->calc_score() + 40;
        return $this->score;
    }

    public function get_title(): string
    {
        $this->title = 'Master Badge';
        return $this->title;
    }
}

class LeaderBadgeDecorator extends BadgeDecorator
{
    public $ref;
    public function __construct($badge)
    {
       $this->ref = $badge;
    }
    public function calc_score(): float
    {
        $this->score = $this->badge->calc_score() + 50;
        return $this->score;
    }

    public function get_title(): string
    {
        $this->title = 'Leader Badge';
        return $this->title;
    }
}
?>