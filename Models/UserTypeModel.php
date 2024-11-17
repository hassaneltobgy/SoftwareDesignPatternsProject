<?php
class UserType {
    public $UserTypeID;
    public $UserType;
    private $conn;

    const ADMIN = 1;
    const VOLUNTEER = 2;
    const GUEST = 3;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Method to create a new UserType
    public function create() {
        $query = "INSERT INTO UserType (UserType) VALUES (?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('s', $this->UserType);

        // Execute query
        return $stmt->execute();
    }

    // Method to read a UserType by its ID
    public function read() {
        $query = "SELECT UserTypeID, UserType FROM UserType WHERE UserTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->UserTypeID);

        // Execute query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Set properties if a row is returned
        if ($row) {
            $this->UserTypeID = $row['UserTypeID'];
            $this->UserType = $row['UserType'];
            return true;
        }

        return false;
    }

    // Method to update a UserType
    public function update() {
        $query = "UPDATE UserType SET UserType = ? WHERE UserTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $this->UserType, $this->UserTypeID);

        // Execute query
        return $stmt->execute();
    }

    // Method to delete a UserType
    public function delete() {
        $query = "DELETE FROM UserType WHERE UserTypeID = ?";
        $stmt = $this->conn->prepare($query);

        // Bind the ID
        $stmt->bind_param('i', $this->UserTypeID);

        // Execute query
        return $stmt->execute();
    }

    // Method to get all user types
    public function getAllUserTypes() {
        $query = "SELECT UserTypeID, UserType FROM UserType";
        $result = $this->conn->query($query);

        // Fetch all user types as an associative array
        $userTypes = [];
        while ($row = $result->fetch_assoc()) {
            $userTypes[] = $row;
        }

        return $userTypes;
    }
}
?>
