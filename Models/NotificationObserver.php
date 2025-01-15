<?php
require_once 'Database.php';
require_once 'NotificationModel.php';

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
        

        for ($i = 0; $i < count($Users); $i++) {
            // Send SMS notification using Twilio or any other SMS gateway
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

        // Send Email notification using PHPMailer or any other email library

        for ($i = 0; $i < count($Users); $i++) {
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
        // Send In-App notification using Firebase Cloud Messaging or any other push notification service
        for ($i = 0; $i < count($Users); $i++) {
            Notification::storeNotification("push notification", $Msg, $Users[$i]->UserID);
        }
    }

}


class NotificationService implements ISubject {
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

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->sendNotification();
        }
    }
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

class ApplicationSubmittedNotificationService extends NotificationService {
    public function __construct($Users) {
        parent::__construct($Users);
        
    }
    public function notify() {
        $Msg = "Application Submitted Successfully, 
        Your Application is under review, we will notify you once it is approved.
        ";
        foreach ($this->observers as $observer) {
            //users here is a list of volunteers 
            $observer->sendNotification($Msg, $this->Users);
        }
    }
}
class UserRegisteredNotificationService extends NotificationService {
    public function __construct($Users) {
        parent::__construct($Users);
    }
    public function notify() {
        $Msg = "Welcome to our platform, you have successfully registered your account.";
        foreach ($this->observers as $observer) {
            // users here is a list of volunteers 
            $observer->sendNotification($Msg, $this->Users);
        }
    }

}
class ApplicationAcceptedNotificationService extends NotificationService {
    private $OrganizationName;
    private $EventName;
    public function __construct($Users, $OrganizationName, $EventName) {
        $this->OrganizationName = $OrganizationName;
        $this->EventName = $EventName;
        parent::__construct($Users);
    }
    public function notify() {
        $Msg = "Congratulations, your application for $this->EventName organized by $this->OrganizationName has been accepted.";
        foreach ($this->observers as $observer) {
            // users here is a list of volunteers
            $observer->sendNotification($Msg, $this->Users);
        }
    }
}
    class ApplicationSubmittedfromVolunteerNotificationService extends NotificationService {
        private $volunteerid;
        public function __construct($volunteerid, $Users) {
            $this->volunteerid = $volunteerid;
            parent::__construct($Users);
        }
        public function notify() {
            $Msg = "A new Application has been submitted by a volunteer with id $this->volunteerid, please review it.";
            foreach ($this->observers as $observer) {
                //users here is a list of only one organization
                $observer->sendNotification($Msg, $this->Users);
            }
        }
    }

    class EventCreatedNotificationService extends NotificationService {
        private $OrganizationName;
        private $EventName;
        public function __construct($Users, $OrganizationName, $EventName) {
            $this->OrganizationName = $OrganizationName;
            $this->EventName = $EventName;
            parent::__construct($Users);
        }
        public function notify() {
            $Msg = "An event $this->EventName has been created by $this->OrganizationName.";
            foreach ($this->observers as $observer) {
                //users here is a list of all volunteers
              $Volunteers = Volunteer::getAllVolunteers();
                $observer->sendNotification($Msg, $Volunteers);
            }
        }
    }




