<?php
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
        String $PASSWORD_HASH,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            return Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $PASSWORD_HASH, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
        }
           return null;
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
        String $PASSWORD_HASH,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            return Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $PASSWORD_HASH, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
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
        String $PASSWORD_HASH,
        String $userType,
        String $LAST_LOGIN,
        String $ACCOUNT_CREATION_DATE
    )
    {
        if ($userType === 'Volunteer') {
            
            return Volunteer::create_Volunteer(
                $FirstName, 
                $LastName, 
                $Email, 
                $PhoneNumber, 
                $DateOfBirth, 
                $USER_NAME, 
                $PASSWORD_HASH, 
                $LAST_LOGIN, 
                $ACCOUNT_CREATION_DATE  );
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
        String $PASSWORD_HASH,
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
            $PASSWORD_HASH,
            $userType,
            $LAST_LOGIN,
            $ACCOUNT_CREATION_DATE

        );
    }
}
