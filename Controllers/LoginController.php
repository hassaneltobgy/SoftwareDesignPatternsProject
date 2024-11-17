<?php

require_once '../Models/LoginMethodStrategies.php';
require_once '../Models/UserModel.php';
require_once '../Models/VolunteerModel.php';
require_once '../Models/RegisterStrategies.php';

class LoginController
{
    private LoginMethodContext $loginContext;
    private RegisterMethodContext $RegisterMethodContext;

    public string $Message = '';
    private string $Error = '';

    public function __construct()
    {
        // Default to email login
        $this->loginContext = new LoginMethodContext();
        $this->RegisterMethodContext = new RegisterMethodContext();
    }


    public function handleRequest()
    {
     
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? null;
            echo "action is $action";  
            switch ($action) {
                case 'login':
                    $this->handleLogin();
                    break;
                case 'signup':
                    $this->handleSignup();
                    break;
                default:
                    $this->renderError("Invalid action.");
                    break;
            }
        }
    }

    public function handleLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
            $provider = $_POST['provider'];
            if ($provider === 'google') {
                $this->loginContext->setProvider(new GoogleAuthenticator());
                $provider = 'Google';
            } elseif ($provider === 'facebook') {
                $this->loginContext->setProvider(new FacebookAuthenticator());
                $provider = 'Facebook';
            } 
         else {
            $this->loginContext->setProvider(new LoginMethodEmail());
            $provider = 'Email';
        }

        $result = $this->loginContext->login($email, $password);

        if ($result) {
            $this->renderMessage("Login successful using $provider! Welcome, " . htmlspecialchars($result->FirstName) . ".");
            header('Location: ../Views/VolunteerView.php');
            exit();
        
        } else {
            $this->renderError("Login failed. Please check your credentials.");
        }
    }

    public function handleSignup()
    {
        ECHO "SIGNUP IN CONTROLLER";  // Debugging output, can be removed later
        $FirstName = $_POST['FirstName'] ?? '';
        $LastName = $_POST['LastName'] ?? '';
        $Email = $_POST['Email'] ?? '';
        $PhoneNumber = $_POST['PhoneNumber'] ?? '';
        $DateOfBirth = $_POST['DateOfBirth'] ?? '';
        $USER_NAME = $_POST['USER_NAME'] ?? '';
        $PASSWORD_HASH = $_POST['PASSWORD_HASH'] ?? '';
        $LAST_LOGIN = date('Y-m-d H:i:s');
        $ACCOUNT_CREATION_DATE = date('Y-m-d H:i:s');
        $UserType = $_POST['user_type'] ?? '';

        if (empty($FirstName) || empty($LastName) || empty($Email) || empty($PASSWORD_HASH)) {
            $this->renderError("All fields are required.");
            return;
        }

            $provider = $_POST['provider'];
            if ($provider === 'google') {
                $this->RegisterMethodContext->setProvider(new GoogleRegister());
                $provider = 'Google';
            } elseif ($provider === 'facebook') {
                $this->RegisterMethodContext->setProvider(new FacebookRegister());
                $provider = 'Facebook';
         
            }
        else {
            $this->RegisterMethodContext->setProvider(new EmailRegister());
            $provider = 'Email';
        }

        $user = $this->RegisterMethodContext->register(
            $FirstName,
            $LastName,
            $Email,
            $PhoneNumber,
            $DateOfBirth,
            $USER_NAME,
            $PASSWORD_HASH,
            $UserType,
            $LAST_LOGIN,
            $ACCOUNT_CREATION_DATE
        );

        if ($user) {
            // $this->renderMessage("Signup successful using $provider. Welcome, $FirstName.");

    $userType = $_POST['user_type']; 
    if ($userType === 'Volunteer') {
        header('Location: ../Views/VolunteerView.php');
    } elseif ($userType === 'Admin') {
        header('Location: AdminDashboard.php');
    } else {
        header('Location: ../Views/LoginView.php');
    }
    exit();

        
        } else {
            $this->renderError("Signup failed. Please try again.");
        }
    }

    public function renderMessage(string $message)
{
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => $message]);
    exit();
}

public function renderError(string $error)
{
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $error]);
    exit();
}

}

$controller = new LoginController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    echo "action is $action";  
    switch ($action) {
        case 'login':
            $controller->handleLogin();
            break;

        case 'signup':
            $controller->handleSignup();
            break;
        default:
            $controller->renderError("Invalid action.");
            break;
    }
}

?>

