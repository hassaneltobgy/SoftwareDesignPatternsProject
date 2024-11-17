<?php


interface ISubject {
    public function add(IObserver $observer);
    public function notify();
}

interface IObserver {
    public function sendNotification();
}


class NotifyBySMSObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyBySMSObserver";


    public function __construct(ISubject $subject, $conn, $subjectId) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);


        // Check if observer type is already linked to this subject
       $stmt = $this->conn->prepare("SELECT id FROM Observers WHERE observer_type = ? AND subject_id = ?");
       $stmt->bind_param("si", $this->observerType, $subjectId);
       $stmt->execute();
       $stmt->store_result();

       // Only insert if there is no existing link
       if ($stmt->num_rows === 0) {
           $stmt->close();
           $stmt = $this->conn->prepare("INSERT INTO Observers (observer_type, subject_id) VALUES (?, ?)");
           $stmt->bind_param("si", $this->observerType, $subjectId);
           $stmt->execute();
       }
       $stmt->close();

    }

    public function sendNotification() {
        $this->storeNotification("SMS", "Notify by SMS");
        echo "SMS notification sent\n";
    }

    private function storeNotification($type, $message) {
        $stmt = $this->conn->prepare("INSERT INTO Notifications (type, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $type, $message);
        $stmt->execute();
        $stmt->close();
        echo "Notification stored in DB: $message\n";
    }
}

class NotifyByEmailObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyByEmailObserver";

    public function __construct(ISubject $subject, $conn, $subjectId) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);

       // Check if observer type is already linked to this subject
       $stmt = $this->conn->prepare("SELECT id FROM Observers WHERE observer_type = ? AND subject_id = ?");
       $stmt->bind_param("si", $this->observerType, $subjectId);
       $stmt->execute();
       $stmt->store_result();

       // Only insert if there is no existing link
       if ($stmt->num_rows === 0) {
           $stmt->close();
           $stmt = $this->conn->prepare("INSERT INTO Observers (observer_type, subject_id) VALUES (?, ?)");
           $stmt->bind_param("si", $this->observerType, $subjectId);
           $stmt->execute();
       }
       $stmt->close();
    }

    public function sendNotification() {
        $this->storeNotification("Email", "Notify by Email");
        echo "Email notification sent\n";
    }

    private function storeNotification($type, $message) {
        $stmt = $this->conn->prepare("INSERT INTO Notifications (type, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $type, $message);
        $stmt->execute();
        $stmt->close();
        echo "Notification stored in DB: $message\n";
    }
}

class NotifyByInAppObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyByInAppObserver";

    public function __construct(ISubject $subject, $conn, $subjectId) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);

        // Check if observer type is already linked to this subject
       $stmt = $this->conn->prepare("SELECT id FROM Observers WHERE observer_type = ? AND subject_id = ?");
       $stmt->bind_param("si", $this->observerType, $subjectId);
       $stmt->execute();
       $stmt->store_result();

       // Only insert if there is no existing link
       if ($stmt->num_rows === 0) {
           $stmt->close();
           $stmt = $this->conn->prepare("INSERT INTO Observers (observer_type, subject_id) VALUES (?, ?)");
           $stmt->bind_param("si", $this->observerType, $subjectId);
           $stmt->execute();
       }
       $stmt->close();

    }

    public function sendNotification() {
        $this->storeNotification("InApp", "Notify by InApp");
        echo "InApp notification sent\n";
    }

    private function storeNotification($type, $message) {
        $stmt = $this->conn->prepare("INSERT INTO Notifications (type, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $type, $message);
        $stmt->execute();
        $stmt->close();
        echo "Notification stored in DB: $message\n";
    }
}


class ConcreteSubject implements ISubject {
    private $observers = [];
    private $conn;
    public function __construct($conn) {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function add(IObserver $observer) {
        $this->observers[] = $observer;
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->sendNotification();
        }
    }
    public function createSubject($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO Subjects (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();
        $subjectId = $stmt->insert_id; // Get the auto-generated subject ID
        $stmt->close();

        return $subjectId;
    }
    public function updateSubject($subjectId, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE Subjects SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $subjectId);
        $stmt->execute();
        $stmt->close();
    }
    public function deleteSubject($subjectId) {
        $stmt = $this->conn->prepare("DELETE FROM Subjects WHERE id = ?");
        $stmt->bind_param("i", $subjectId);
        $stmt->execute();
        $stmt->close();
    }

}


