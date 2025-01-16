<?php
class UserFactory
{
    public static function createUser(
        string $userType,
        string $firstName,
        string $lastName,
        string $email,
        string $phoneNumber,
        string $dateOfBirth,
        string $userName,
        string $passwordHash,
        string $lastLogin,
        string $accountCreationDate
    ) {
        switch ($userType) {
            case 'Volunteer':
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
            case 'Organization':
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
            case 'Admin':
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
