<?php

class EmergencyContact{
private $EmergencyContactID;
private $Name;
private $PhoneNumber;
private $conn;

public function __construct($id= null, $Name = '', $PhoneNumber = '') {
    $this->conn = Database::getInstance()->getConnection();
    $this->Name = $Name;
    $this->PhoneNumber = $PhoneNumber;
    $this->EmergencyContactID = $id;

}

public function getName() {
    return $this->Name;
}
public function setName($Name) {
    $this->Name = $Name;
}


public function getPhoneNumber() {
    return $this->PhoneNumber;
}
public function setPhoneNumber($PhoneNumber) {
    $this->PhoneNumber = $PhoneNumber;
}
public function getID() {
    return $this->EmergencyContactID;
}

public static function create ($Name, $PhoneNumber) {
    $conn = Database::getInstance()->getConnection();
    // first check if the emergency contact already exists 
    $query = "SELECT * FROM EmergencyContact WHERE EmergencyContactName = ? AND EmergencyContactPhone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $Name, $PhoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    if ($row) {
        $emergencyContact = new EmergencyContact($row['EmergencyContactID'], $row['EmergencyContactName'], $row['EmergencyContactPhone']);
        return $emergencyContact;
    }

    $query = "INSERT INTO EmergencyContact (EmergencyContactName, EmergencyContactPhone) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $Name, $PhoneNumber);
    $stmt->execute();
    $stmt->close();
    $emergencyContact = new EmergencyContact($conn->insert_id, $Name, $PhoneNumber);
    return $emergencyContact;



}


public static function getEmergencyContact($id) {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT * FROM EmergencyContact WHERE EmergencyContactID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}


public static function getEmergencyContactId($Name, $PhoneNumber) {
    $conn = Database::getInstance()->getConnection();
    $query = "SELECT EmergencyContactID FROM EmergencyContact WHERE EmergencyContactName = ? AND EmergencyContactPhone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $Name, $PhoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['EmergencyContactID'];
}

public function update ($Name, $PhoneNumber) {
    $query = "UPDATE EmergencyContact SET EmergencyContactName = ?, EmergencyContactPhone = ? WHERE EmergencyContactID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('ssi', $Name, $PhoneNumber, $this->EmergencyContactID);
    $stmt->execute();
    $stmt->close();
}
}
?>