<?php
require_once '../Models/VolunteerModel.php';
require_once '../Models/AdminModel.php';
require_once '../Models/OrganizationModel.php';
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


class FacebookRegister implements RegisterMethodStrategy
{
    public function register(
        String $FirstName,
        String $LastName,
        String $Email,
        String $PhoneNumber,
        String $DateOfBirth,
        String $USER_NAME,
        String $password,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            $volunteer = Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
                return "Successfully registered with Facebook as a volunteer";
        }
        else if ($userType === 'Organization') {
            $organization = Organization::create_Organization(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an organization";

        }
        else if ($userType === 'Admin') {
            $admin = Admin::create_admin(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an admin";
        }
       
    }
}

   


class GoogleRegister implements RegisterMethodStrategy
{
    public function register(
        String $FirstName,
        String $LastName,
        String $Email,
        String $PhoneNumber,
        String $DateOfBirth,
        String $USER_NAME,
        String $password,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            $volunteer = Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
                return "Successfully registered with Facebook as a volunteer";
        }
        else if ($userType === 'Organization') {
            $organization = Organization::create_Organization(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an organization";

        }
        else if ($userType === 'Admin') {
            $admin = Admin::create_admin(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an admin";
        }


           return null;
        }
       
    }

   

class EmailRegister implements RegisterMethodStrategy
{
    public function register(
        String $FirstName,
        String $LastName,
        String $Email,
        String $PhoneNumber,
        String $DateOfBirth,
        String $USER_NAME,
        String $password,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            $volunteer = Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
                return "Successfully registered with Facebook as a volunteer";
        }
        else if ($userType === 'Organization') {
            $organization = Organization::create_Organization(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an organization";

        }
        else if ($userType === 'Admin') {
            $admin = Admin::create_admin(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $password, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE );
                return "Successfully registered with Facebook as an admin";
        }
           return null;
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
        String $FirstName,
        String $LastName,
        String $Email,
        String $PhoneNumber,
        String $DateOfBirth,
        String $USER_NAME,
        String $password,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        return $this->strategy->register(
            $FirstName,
            $LastName,
            $Email,
            $PhoneNumber,
            $DateOfBirth,
            $USER_NAME,
            $password,
            $userType,
            $LAST_LOGIN,
            $ACCOUNT_CREATION_DATE

        );
    }
}
