<?php
require "../vendor/autoload.php";
require_once '../Controllers/LoginController.php';
$controller = new LoginController();
$client = new Google\Client;


$client->setClientId("572633447608-3atq4co4mq3dqqbgidlev8istr33i48n.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:3000/Views/googlesignin.php");

if ( ! isset($_GET["code"])) {

    exit("Login failed");

}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);
$userInfo = $oauth->userinfo->get();

// Example user data
$email = $userInfo->email; // User's email
$name = $userInfo->name;   // User's name

// first check if the email exists in the database
if ($controller->emailExists($email)) {
    // If the email exists, redirect to the appropriate page based on the user's role
    $role = $controller->determineUserRole($email); // You need to implement this function
    switch ($role) {
        case "volunteer":
            // header("Location: ../Views/VolunteerMainScreen.php?email=" . urlencode($email));
            header("Location: ../Views/VolunteerProfileView.php?email=" . urlencode($email));
            break;
        case "admin":
            header("Location: ../Views/AdminControlPanel.php?email=" . urlencode($email));
            break;
        case "organization":
            header("Location: ../Views/OrganizationMainScreen.php?email=" . urlencode($email));
            break;
        default:
            exit("Error: Role not recognized.");
    }
    exit();
}
else {
    // If the email does not exist, redirect to the signup page
    header("Location: ../Views/Signup.php?email=" . urlencode($email));
    exit();
}

 

?>