<?php
require_once '../Models/UserModel.php';  
require_once '../Models/VolunteerModel.php';
require_once '../Models/AdminModel.php';
require_once '../Models/OrganizationModel.php';
class UserController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User();
    }

    // Get all Users and pass them to the view
    public function getAllUsers() {
        return User::get_all_users();
    }

    
    public function updateUser($data) {

        //echo "now updating user with id: $data[UserID]"; 
        //echo "UserType: $data[UserType]";      
        if (strtolower($data['UserType']) == 'volunteer') {
            $volunteer = new Volunteer();

            $volunteer->update(UserID:$data['UserID'] ,FirstName: $data['FirstName'],LastName: $data['LastName'], Email: $data['Email'], PhoneNumber: $data['PhoneNumber'], DateOfBirth:$data['DateOfBirth'], USER_NAME: $data['USER_NAME'], password: $data['PASSWORD_HASH'],
            privileges: $data['privileges']);
            }
        else if ($data['UserType'] == 'admin') {
            $admin = new Admin();   
            $admin->update(UserID:$data['UserID'] ,FirstName: $data['FirstName'],LastName: $data['LastName'], Email: $data['Email'], PhoneNumber: $data['PhoneNumber'], DateOfBirth:$data['DateOfBirth'], USER_NAME: $data['USER_NAME'], password: $data['PASSWORD_HASH'],
            privileges: $data['privileges']);

        }
        else if ($data['UserType'] == 'organization') {
            $organization = new Organization();
            $organization->update(UserID:$data['UserID'] ,FirstName: $data['FirstName'],LastName: $data['LastName'], Email: $data['Email'], PhoneNumber: $data['PhoneNumber'], DateOfBirth:$data['DateOfBirth'], USER_NAME: $data['USER_NAME'], password: $data['PASSWORD_HASH'],
            privileges: $data['privileges']);

        }
    }
    public function add_privilege($data) {
        $User = new User($data['UserID']);
        $User->addprivilege($data['privileges']);
    }
    
    // Create a new User
    public function createUser($data) {
        // Collect form data for User creation
        if ($data['UserType'] == 'volunteer') {
            // set last login and account creation date to current date
            $data['LAST_LOGIN'] = date('Y-m-d H:i:s');
            $data['ACCOUNT_CREATION_DATE'] = date('Y-m-d H:i:s');
            Volunteer::create_Volunteer($data['FirstName'], $data['LastName'], $data['Email'], $data['PhoneNumber'], $data['DateOfBirth'], $data['USER_NAME'], $data['PASSWORD_HASH'], $data['LAST_LOGIN'], $data['ACCOUNT_CREATION_DATE'],
            $data['privileges']);
            }
        else if ($data['UserType'] == 'admin') {
            // set last login and account creation date to current date
            $data['LAST_LOGIN'] = date('Y-m-d H:i:s');
            $data['ACCOUNT_CREATION_DATE'] = date('Y-m-d H:i:s');
            Admin::create_admin($data['FirstName'], $data['LastName'], $data['Email'], $data['PhoneNumber'], $data['DateOfBirth'], $data['USER_NAME'], $data['PASSWORD_HASH'], $data['LAST_LOGIN'], $data['ACCOUNT_CREATION_DATE'],
            $data['privileges']);
        }
        else if ($data['UserType'] == 'organization') {
            $data['LAST_LOGIN'] = date('Y-m-d H:i:s');
            $data['ACCOUNT_CREATION_DATE'] = date('Y-m-d H:i:s');
            Organization::create_Organization($data['FirstName'], $data['LastName'], $data['Email'], $data['PhoneNumber'], $data['DateOfBirth'], $data['USER_NAME'], $data['PASSWORD_HASH'], $data['LAST_LOGIN'], $data['ACCOUNT_CREATION_DATE'],
            $data['privileges']);
        }
    }


    // Delete a User by ID
    public function deleteUser($id) {
        $User = new User($id);
        //echo "now deleting user with id: $id";
        return $User->delete();
    }
}

// Handle POST actions outside the class
// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $UserController = new UserController();
    // //echo "user type is : ".$_POST['UserType'];
    switch ($_POST['action']) {
        case 'addUserAnduser':
            //echo "addUserAndUser";
            $data = [
                'UserType' => $_POST['UserType'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'Email' => $_POST['Email'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'DateOfBirth' => $_POST['DateOfBirth'],
                'USER_NAME' => $_POST['USER_NAME'],
                'PASSWORD_HASH' => $_POST['PASSWORD_HASH'],
                 'privileges' => $_POST['Privileges']?? null
            ];
            $UserController->createUser($data);
            break;

        case 'updateuser':
            //echo "updateUser";
            $data = [
                'UserType' => $_POST['UserType'],
                'UserID' => $_POST['UserID'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'Email' => $_POST['Email'],
                'PhoneNumber' => $_POST['PhoneNumber'],
                'DateOfBirth' => $_POST['DateOfBirth'],
                'USER_NAME' => $_POST['USER_NAME'],
                'PASSWORD_HASH' => $_POST['PASSWORD_HASH'],
                'privileges' => $_POST['Privileges']?? null

            ];
            $UserController->updateUser($data);
            break;
        case 'deleteuser':
            //echo "case is deleteUser";
            $UserController->deleteUser($_POST['UserID']);
            break;
    }
}

?>
