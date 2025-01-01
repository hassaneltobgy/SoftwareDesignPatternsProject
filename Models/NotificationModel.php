<?php
class Notification {

private $conn;
private $table_name = "Notification";
private $NotificationMessage;
private $NotificationTime;
private $NotificationTypeID;


public function __construct($id= null){
    $this->conn = new Database();
    if($id){
 
    }
}



}
?>
