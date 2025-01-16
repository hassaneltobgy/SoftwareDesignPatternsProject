<?php
class UserFactory
{
    public static function createUser(
        string $userType,
        string $firstName,
        string $lastName = null,
        string $email,
        string $phoneNumber= null,
        string $dateOfBirth = null,
        string $userName,
        string $passwordHash,
        string $lastLogin,
        string $accountCreationDate
    ) {
        // convert to lower case 
        $userType = strtolower($userType);
        switch ($userType) {
            case 'volunteer':
                return Volunteer::create_Volunteer(
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
            case 'organization':
                return Organization::create_Organization(
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
            case 'admin':
                return Admin::create_admin(
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
            default:
                throw new InvalidArgumentException("Invalid user type: $userType");
        }
    }
}
?>
