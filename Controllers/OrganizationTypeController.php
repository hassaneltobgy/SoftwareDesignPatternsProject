<?php

require_once '../Models/OrganizationTypeModel.php';
class OrganizationTypeController {
    private $OrganizationTypeModel;
    public function __construct() {
        $this->OrganizationTypeModel = new OrganizationType();
    }

    public function get_all_OrganizationTypes() {
        return OrganizationType::getAllOrganizationTypes();
    }

    
    public function updateOrganizationType($data) {

        echo "now updating OrganizationType with id: $data[OrganizationTypeID]"; 
        
        $OrganizationType = new OrganizationType($data['OrganizationTypeID']);
        $OrganizationType->update($data['OrganizationTypeName']);

    }
    public function add_OrganizationType($data) {
        $OrganizationType = new OrganizationType();
        $OrganizationType->create($data['OrganizationTypeName']);
    }
    

    public function deleteOrganizationType($id) {
        $OrganizationType = new OrganizationType($id);
        echo "now deleting OrganizationType with id: $id";
        return $OrganizationType->delete();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $OrganizationTypeController = new OrganizationTypeController();
    switch ($_POST['action']) {
        case 'addOrganizationType':
            echo "addOrganizationType";
            $data = [
                'OrganizationTypeName' => $_POST['OrganizationTypeName'],
            ];
            $OrganizationTypeController->add_OrganizationType($data);
            break;

        case 'updateOrganizationType':
            echo "updateOrganizationType";
            $data = [
                'OrganizationTypeName' => $_POST['OrganizationTypeName'],
                'OrganizationTypeID' => $_POST['OrganizationTypeID']

            ];
            $OrganizationTypeController->updateOrganizationType($data);
            break;
        case 'deleteOrganizationType':
            echo "case is deleteOrganizationType";
            $OrganizationTypeController->deleteOrganizationType($_POST['OrganizationTypeID']);
            break;
    }
}

?>
