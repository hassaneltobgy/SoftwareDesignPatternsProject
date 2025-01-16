<?php
require_once '../Models/VolunteerModel.php';
require_once '../Models/AdminModel.php';
require_once '../Models/OrganizationModel.php';
require_once '../Models/NotificationObserver.php';
require_once '../Models/NotificationModel.php';
require_once '../Models/NotificationType.php';
require '../Models/UserFactory.php';

interface RegisterMethodStrategy
{
    public function register(
        String $firstName,
        String $lastName,
        String $email,
        String $phoneNumber,
        String $dateOfBirth,
        String $userName,
        String $passwordHash,
        String $userType,
        String $lastLogin,
        String $accountCreationDate
    );
}



abstract class AbstractRegister implements RegisterMethodStrategy
{
    abstract protected function getRegistrationMessage(string $userType): string;

    public function register(
        String $firstName,
        String $lastName,
        String $email,
        String $phoneNumber,
        String $dateOfBirth,
        String $userName,
        String $passwordHash,
        String $userType,
        String $lastLogin,
        String $accountCreationDate
    ) {
        $user = UserFactory::createUser(
            $userType,
            $firstName,
            $lastName,
            $email,
            $phoneNumber,
            $dateOfBirth,
            $userName,
            $passwordHash,
            $lastLogin,
            $accountCreationDate
        );

        $message = $this->getRegistrationMessage($userType);

        return [
            'message' => $message . " for $email",
            'user' => $user
        ];
    }
}

class FacebookRegister extends AbstractRegister
{
    protected function getRegistrationMessage(string $userType): string
    {
        return "Successfully registered with Facebook as a $userType";
    }
}

class GoogleRegister extends AbstractRegister
{

    public function register(
        String $firstName,
        String $lastName,
        String $email,
        String $phoneNumber,
        String $dateOfBirth,
        String $userName,
        String $passwordHash,
        String $userType,
        String $lastLogin,
        String $accountCreationDate
    ) {
        $client = new Google\Client;
    
        $client->setClientId("572633447608-3atq4co4mq3dqqbgidlev8istr33i48n.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $userType = strtolower($userType);
        if ($userType=="volunteer")
        {$client->setRedirectUri("http://localhost:3000/Views/googlesignupvolunteer.php");
        }else if ($userType=="organization")
        {$client->setRedirectUri("http://localhost:3000/Views/googlesignuporganization.php");
        }else
        {$client->setRedirectUri("http://localhost:3000/Views/googlesignupadmin.php");
        }
        $client->addScope("email");
        $client->addScope("profile");
    
        $url = $client->createAuthUrl();
    
        // Store the message in the session for later use
        session_start();
        $message = $this->getRegistrationMessage($userType);
        $_SESSION['message'] = $message;  // Store message in the session
        
        return [
            'message' => $message . " url is $url",
            'user' => null
        ];
    }
    


    protected function getRegistrationMessage(string $userType): string
    {
        return "registering with Google as a $userType";
    }
}

class EmailRegister extends AbstractRegister
{
    protected function getRegistrationMessage(string $userType): string
    {
        return "Successfully registered with Email as a $userType";
    }
}

class RegisterMethodContext
{
    private RegisterMethodStrategy $strategy;

    public function __construct(RegisterMethodStrategy $strategy = null)
    {
        $this->strategy = $strategy ?? new EmailRegister();
    }

    public function setProvider(RegisterMethodStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function register(
        String $firstName,
        String $lastName,
        String $email,
        String $phoneNumber,
        String $dateOfBirth,
        String $userName,
        String $passwordHash,
        String $userType,
        String $lastLogin,
        String $accountCreationDate
    ) {
        $result = $this->strategy->register(
            $firstName,
            $lastName,
            $email,
            $phoneNumber,
            $dateOfBirth,
            $userName,
            $passwordHash,
            $userType,
            $lastLogin,
            $accountCreationDate
        );

        $message = $result['message'];
        $user = $result['user'];

        if ($user === null) {
            echo "User is null";
        } else {
            echo "User is not null, user id is: " . $user->UserID;
        }

        if ($message !== null && $user !== null) {
            $notificationId = NotificationType::getNotificationTypeIdByName("email");

            $user->add_notification_type($notificationId);

            $userRegisteredNotificationService = new UserRegisteredNotificationService([$user]);
            $smsObserver = new NotifyByEmailObserver($userRegisteredNotificationService);
            $userRegisteredNotificationService->notify();
        }

        return $message;
    }
}
