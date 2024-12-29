<?php

require_once '../Models/PrivilegeModel.php';
class PrivilegeController {
    private $PrivilegeModel;
    public function __construct() {
        $this->PrivilegeModel = new Privilege();
    }

    public function get_all_privileges() {
        return Privilege::getAllPrivileges();
    }

    
    public function updateprivilege($data) {

        echo "now updating privilege with id: $data[privilegeID]"; 
        
        $privilege = new privilege($data['privilegeID']);
        $privilege->update($data['privilegeName'], $data['Description'], $data['AccessLevel']);

    }
    public function add_privilege($data) {
        $privilege = new privilege();
        $privilege->create($data['privilegeName'], $data['Description'], $data['AccessLevel']);
    }
    

    public function deleteprivilege($id) {
        $privilege = new privilege($id);
        echo "now deleting privilege with id: $id";
        return $privilege->delete();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $privilegeController = new privilegeController();
    switch ($_POST['action']) {
        case 'addPrivilege':
            echo "addPrivilege";
            $data = [
                'privilegeName' => $_POST['PrivilegeName'],
                'Description' => $_POST['Description'],
                'AccessLevel' => $_POST['AccessLevel'],
            ];
            $privilegeController->add_privilege($data);
            break;

        case 'updateprivilege':
            echo "updateprivilege";
            $data = [
                'privilegeName' => $_POST['PrivilegeName'],
                'Description' => $_POST['Description'],
                'AccessLevel' => $_POST['AccessLevel'],
                'privilegeID' => $_POST['PrivilegeID']

            ];
            $privilegeController->updateprivilege($data);
            break;
        case 'deleteprivilege':
            echo "case is deleteprivilege";
            $privilegeController->deleteprivilege($_POST['PrivilegeID']);
            break;
    }
}

?>
