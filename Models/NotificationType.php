<?php
class NotificationType
 {
    public $NotificationTypeID;
    public $TypeName;
    private $conn;


    private $table_name = "NotificationType";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public static function get_all() {
        $query = "SELECT * FROM NotificationType";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function get_by_id($id) {
        $query = "SELECT * FROM NotificationType WHERE NotificationTypeID = ? LIMIT 1";
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $notificationType = new NotificationType();
            $notificationType->NotificationTypeID = $row['NotificationTypeID'];
            $notificationType->TypeName = $row['TypeName'];
            return $notificationType;
        }
        return null;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (TypeName) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->TypeName);

        if ($stmt->execute()) {
            $this->NotificationTypeID = $this->conn->insert_id;
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET TypeName = ? WHERE NotificationTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->TypeName, $this->NotificationTypeID);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE NotificationTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->NotificationTypeID);

        return $stmt->execute();
    }
}
?>