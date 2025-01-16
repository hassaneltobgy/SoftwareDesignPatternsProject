<?php
// session_start();

require "../vendor/autoload.php";
interface LoginMethodStrategy
{
    public function login(String $email, String $password);
}

class FacebookAuthenticator implements LoginMethodStrategy
{
    public function login(String $email, String $password)
    {
        $user = User::get_by_email($email);
        echo "user type is $user->UserType";
        // get user type
        $userType = $user->UserType;
        $isPasswordCorrect = password_verify($password, $user->PASSWORD_HASH);
        echo "password is $password    ";
        echo "password hash is $user->PASSWORD_HASH    ";
        echo "password is $isPasswordCorrect    ";
        echo "applying bycrypt encryption to the password password with hash ".password_hash($password, PASSWORD_BCRYPT);
        if ($user && password_verify($password, $user->PASSWORD_HASH)) {
            return "successfully logged in with Facebook as a $userType Email is $email"; // Login successful
        }
        
        return null; // Invalid credentials
    }
}


class GoogleAuthenticator implements LoginMethodStrategy
{
    public function login(String $email, String $password)
    {
        // Fetch the stored hash from the database for the given email
        // $user = User::get_by_email($email); 
        // $userType = $user->UserType;

        // If the user exists, verify the password using password_verify
        // if ($user && password_verify($password, $user->PASSWORD_HASH)) {
        //     return  "successfully logged in with Google as a $userType"; // Login successful
        // }

        

        $client = new Google\Client;

        $client->setClientId("572633447608-3atq4co4mq3dqqbgidlev8istr33i48n.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $client->setRedirectUri("http://localhost:3000/Views/googlesignin.php");

        $client->addScope("email");
        $client->addScope("profile");

        $url = $client->createAuthUrl();
                
        return "Logging in with Google url is $url"; 
    }
}



class LoginMethodEmail implements LoginMethodStrategy
{
    public function login(String $email, String $password)
    {
        // Fetch the stored hash from the database for the given email
        $user = User::get_by_email($email); 
        $userType = $user->UserType;

        if (!$user)
        {
           echo "user not found";
        }
       


        // If the user exists, verify the password using password_verify
        if ($user && password_verify($password, $user->PASSWORD_HASH)) {
            // $_SESSION['email'] = $email; // Store user email
            return "successfully logged in with Email as a $userType Email is $email"; // Login successful
        }
        echo "password is incorrect";
        return null; // Invalid credentials
    }
}


class LoginMethodContext
{
    private LoginMethodStrategy $strategy;

    public function __construct(LoginMethodStrategy $strategy = null)
    {
        $this->strategy = $strategy ?? new LoginMethodEmail();
    }

    public function setProvider(LoginMethodStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function login(String $email, String $password): ?String
    {
        return $this->strategy->login($email, $password);
    }
}

