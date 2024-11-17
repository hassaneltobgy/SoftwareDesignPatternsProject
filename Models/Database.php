<?php
class Database {
    protected $conn;
    private static $instance;


    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', 'Deda2782002!', 'VolunteerManagementSystem');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
