<?php
class Notification {

private $conn;
private $table_name = "Notification";
private $NotificationMessage;
private $NotificationTime;
private $NotificationTypeID;


public function __construct($id= null){
    $this->conn = Database::getInstance()->getConnection();
  
}
public static function createNotification($NotificationMessage, $NotificationTime, $NotificationTypeID){
    $query = "INSERT INTO Notification (NotificationMessage, NotificationTime, notificationtypeid) VALUES (?, ?, ?)";
    $conn = Database::getInstance()->getConnection();
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $NotificationMessage, $NotificationTime, $NotificationTypeID);
    if ($stmt->execute() == false)
    echo "Error: " . $stmt->error;
    $stmt->close();
    return $conn->insert_id;
}

public static function storeNotification($type, $message, $userId) {
    $typeId= NotificationType::getNotificationTypeIdByName($type);
    $conn = Database::getInstance()->getConnection();
    $formattedTime =date('Y-m-d H:i:s');
    $NotificationId= Notification::createNotification($message, $formattedTime, $typeId);
    
    
    $stmt = $conn->prepare("INSERT INTO User_Notifications (notification_id, user_id) VALUES (?, ?)");
    echo "NotificationId: $NotificationId\n";
    echo "UserID: $userId\n";
    $stmt->bind_param("ii", $NotificationId, $userId);
    if ($stmt->execute() == false)
    echo "Error: " . $stmt->error;
    
    $stmt->close();
    echo "Notification stored in DB: $message\n";
}




}
?>
