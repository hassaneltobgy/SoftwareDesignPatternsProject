<?php
require_once 'Database.php';
require_once 'NotificationModel.php';
require_once '../Models/NotificationSender.php';

interface ISubject {
    public function add(IObserver $observer);
    public function notify();
}

interface IObserver {
    public function sendNotification($Msg, $Users);
}


class NotifyBySMSObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyBySMSObserver";


    public function __construct(ISubject $subject) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);

    }

    public function sendNotification($Msg, $Users) {
        $smsService = new SMSNotificationService();
        $smsNotificationAdapter = new SmsNotificationAdapter($smsService);

        for ($i = 0; $i < count($Users); $i++) {
            // Send SMS notification using Twilio or any other SMS gateway
            echo "Now Sending SMS to {$Users[$i]->PhoneNumber}";
            $smsNotificationAdapter->send($Msg, $Users[$i]->PhoneNumber);
            Notification::storeNotification("sms", $Msg, $Users[$i]->UserID);
        }
    }

    
}

class NotifyByEmailObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyByEmailObserver";

    public function __construct(ISubject $subject) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);
    }

    public function sendNotification($Msg, $Users) {
        $emailService = new EmailService();
        $emailNotificationAdapter = new EmailNotificationAdapter($emailService);
        // Send Email notification using PHPMailer or any other email library

        for ($i = 0; $i < count($Users); $i++) {
            $emailNotificationAdapter->send($Users[$i]->Email, $Msg);
            Notification::storeNotification("email", $Msg, $Users[$i]->UserID);
        }
    }

 
}

class NotifyByInAppObserver implements IObserver {
    private $subject;
    private $conn;
    private $observerType = "NotifyByInAppObserver";

    public function __construct(ISubject $subject) {
        $this->subject = $subject;
        $this->conn = Database::getInstance()->getConnection();
        $this->subject->add($this);


    }

    public function sendNotification($Msg, $Users) {
        for ($i = 0; $i < count($Users); $i++) {
            Notification::storeNotification("push notification", $Msg, $Users[$i]->UserID);
        }
    }

}

abstract class NotificationServiceTemplate implements ISubject {
    protected $observers = [];
    protected $Users = [];
    private $conn;

    public function __construct($Users) {
        $this->Users = $Users;
        $this->conn = Database::getInstance()->getConnection();
    }

    public function add(IObserver $observer) {
        $this->observers[] = $observer;
    }

    // Template method
    public function notify() {
        $message = $this->createMessage();
        $recipients = $this->determineRecipients();

        foreach ($this->observers as $observer) {
            $observer->sendNotification($message, $recipients);
        }
    }

    // Abstract methods for customization in subclasses
    abstract protected function createMessage();
    abstract protected function determineRecipients();

    public function createSubject($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO Subjects (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();
        $subjectId = $stmt->insert_id;
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

class ApplicationSubmittedNotificationService extends NotificationServiceTemplate {
    protected function createMessage() {
        return "Application Submitted Successfully, \nYour Application is under review, we will notify you once it is approved.";
    }

    protected function determineRecipients() {
        return $this->Users;
    }
}

class UserRegisteredNotificationService extends NotificationServiceTemplate {
    protected function createMessage() {
        return "Welcome to our platform, you have successfully registered your account.";
    }

    protected function determineRecipients() {
        return $this->Users;
    }
}

class ApplicationAcceptedNotificationService extends NotificationServiceTemplate {
    private $OrganizationName;
    private $EventName;

    public function __construct($Users, $OrganizationName, $EventName) {
        $this->OrganizationName = $OrganizationName;
        $this->EventName = $EventName;
        parent::__construct($Users);
    }

    protected function createMessage() {
        return "Congratulations, your application for $this->EventName organized by $this->OrganizationName has been accepted.";
    }

    protected function determineRecipients() {
        return $this->Users;
    }
}

class ApplicationSubmittedFromVolunteerNotificationService extends NotificationServiceTemplate {
    private $volunteerId;

    public function __construct($volunteerId, $Users) {
        $this->volunteerId = $volunteerId;
        parent::__construct($Users);
    }

    protected function createMessage() {
        return "A new Application has been submitted by a volunteer with ID $this->volunteerId, please review it.";
    }

    protected function determineRecipients() {
        return $this->Users;
    }
}

class EventCreatedNotificationService extends NotificationServiceTemplate {
    private $OrganizationName;
    private $EventName;

    public function __construct($Users, $OrganizationName, $EventName) {
        $this->OrganizationName = $OrganizationName;
        $this->EventName = $EventName;
        parent::__construct($Users);
    }

    protected function createMessage() {
        return "An event $this->EventName has been created by $this->OrganizationName.";
    }

    protected function determineRecipients() {
        return Volunteer::getAllVolunteers();
    }
}





