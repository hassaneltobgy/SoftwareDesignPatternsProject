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
    

    public function __construct($badge_id)
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
                  INNER JOIN BadgePrivilege bp ON p.PrivilegeID = bp.PrivilegeID
                  WHERE bp.BadgeID = ?";
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
        $query = "INSERT INTO BadgePrivilege (BadgeID, PrivilegeID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $this->badge_id, $privilege->PrivilegeID);
    
        if ($stmt->execute()) {
            $this->privileges[] = $privilege;
            return  $privilege;
        }
        
        return null;
    }
    

    public function remove_privilege($privilege) {
            $query = "DELETE FROM BadgePrivilege WHERE BadgeID = ? AND PrivilegeID = ?";
            $stmt = $this->conn->prepare($query);

            $stmt->bind_param('ii', $this->badge_id, $privilege->PrivilegeID);

            return $stmt->execute();
        }

public function modify_privilege_for_a_certain_badge($old_privilege, $new_privilege) {
    $this->remove_privilege($old_privilege);
    return $this->add_privilege($new_privilege);
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

    // Update the badge record in the database with the new score and title
    private function update_badge_in_db()
{
    // Get the new score and title from the decorator
    $score = $this->calc_score();
    $title = $this->get_title();

    // First, check if the badge already exists
    $query = "SELECT badge_id FROM $this->tableName WHERE badge_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $this->badge_id);
    $stmt->execute();
    $stmt->store_result();  // Store the result for checking the row count
    $exists = $stmt->num_rows > 0;  // Check if any rows exist with this badge_id
    $stmt->close();

    if ($exists) {
        // Badge exists, so update it
        $update_query = "UPDATE $this->tableName SET score = ?, title = ? WHERE badge_id = ?";
        $update_stmt = $this->conn->prepare($update_query);
        $update_stmt->bind_param("isi", $score, $title, $this->badge_id);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        // Badge doesn't exist, so insert a new record
        $insert_query = "INSERT INTO $this->tableName (badge_id, score, title) VALUES (?, ?, ?)";
        $insert_stmt = $this->conn->prepare($insert_query);
        $insert_stmt->bind_param("iis", $this->badge_id, $score, $title);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
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