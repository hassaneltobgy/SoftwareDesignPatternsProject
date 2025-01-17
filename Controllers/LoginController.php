<?php

require_once '../Models/LoginMethodStrategies.php';
require_once '../Models/UserModel.php';
require_once '../Models/UserTypeModel.php';
require_once '../Models/RegisterStrategies.php';
class LoginController
{
    private LoginMethodContext $loginContext;
    private RegisterMethodContext $RegisterMethodContext;

    public string $Message = '';

    public function __construct()
    {
        // Default to email login
        $this->loginContext = new LoginMethodContext();
        $this->RegisterMethodContext = new RegisterMethodContext();
    }
    public function emailExists($email)
    {
        $user = User::get_by_email($email);
        return $user;
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
                    $this->Message = "Invalid action";
                    break;
            }
        }
    }

    public function handleLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $provider = $_POST['provider'] ?? 'email';
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
            $this->Message = "$result";
        } else {
            $this->Message = "Failed to log in with $result";
        }

      
    }

    public function handleSignup()
    {
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

        // if (empty($FirstName) || empty($LastName) || empty($Email) || empty($PASSWORD_HASH)) {
        //     $this->Message = "Please fill in all required fields";
        //     return;
        // }

            $provider = $_POST['provider'] ?? 'email';
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

        $result = $this->RegisterMethodContext->register(
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

        if ($result) {
            $this->Message = "$result";
        } else {
            $this->Message = "Failed to sign up with $provider";
        }

       
    }
    public function determineUserRole($email)
    {
        $user = User::get_by_email($email);
        return $user->UserType;
    }


}

$controller = new LoginController();
$controller->handleRequest();
echo "$controller->Message";
require_once '../Views/LoginView.php';
?>
