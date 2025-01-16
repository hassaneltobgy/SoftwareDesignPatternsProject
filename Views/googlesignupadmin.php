<?php
require "../vendor/autoload.php";
require_once '../Controllers/LoginController.php';
require_once '../Models/VolunteerModel.php';
require_once '../Models/AdminModel.php';
require_once '../Models/OrganizationModel.php';
require_once '../Models/NotificationObserver.php';
require_once '../Models/NotificationModel.php';
require_once '../Models/NotificationType.php';
require_once '../Models/UserFactory.php';



$controller = new LoginController();
$client = new Google\Client;

$client->setClientId("572633447608-3atq4co4mq3dqqbgidlev8istr33i48n.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:3000/Views/googlesignupadmin.php");

if (!isset($_GET["code"])) {
    exit("Login failed");
}



$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);
$userInfo = $oauth->userinfo->get();

// Example user data
$email = $userInfo->email; // User's email
$name = $userInfo->name;   // User's name
$phone = $userInfo->phone; // User's phone number
$dateOfBirth = $userInfo->dateOfBirth; // User's date of birth
$todaysDate = date("Y-m-d");


$user = UserFactory::createUser(
    "admin",
    $name,
    ' ',
    $email,
    $phone,
    $dateOfBirth,
    $email,
    ' ',
    $todaysDate,
    $todaysDate
);

$notificationId = NotificationType::getNotificationTypeIdByName("email");

$user->add_notification_type($notificationId);

// $userRegisteredNotificationService = new UserRegisteredNotificationService([$user]);
// $smsObserver = new NotifyByEmailObserver($userRegisteredNotificationService);
// $userRegisteredNotificationService->notify();


header("Location: ../Views/AdminControlPanel.php?email=" . urlencode($email));
// header("Location: ../Views/AdminControlPanel.php");
     
exit();

 

?>