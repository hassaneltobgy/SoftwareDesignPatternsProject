<?php
class Database {
    protected $conn;
    private static $instance;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', 'Hassan5522#', 'VolunteerManagementSystem');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo "Database connected successfully.<br>";
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        if ($this->conn->ping()) {
            echo "Database connection is active.<br>";
        } else {
            echo "Database connection is not active.<br>";
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
        echo "Database connection closed.<br>";
    }
}

// Example usage:
$db = Database::getInstance();
$conn = $db->getConnection();
$db->closeConnection();
?>
