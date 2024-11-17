<?php
require_once 'C:\Users\HP\Downloads\Phase1\Models\OrganizataionModel.php'; 
class OrganizationController {
    private $organizationModel;

    public function __construct() {
        $this->organizationModel = new Organization();
    }

    // Get all organizations and pass them to the view
    public function getAllOrganizations() {
        // Use direct database logic if not available in the model
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM Organization";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $organizations = [];
        while ($row = $result->fetch_assoc()) {
            $organizations[] = $row;
        }

        return $organizations;
    }

    // Create a new organization
    public function createOrganization($data) {
        // Collect form data for organization creation
        $OrganizationName = $data['OrganizationName'];
        $OrganizationDescription = $data['OrganizationDescription'];
        $OrganizationEmail = $data['OrganizationEmail'];
        $OrganizationPhone = $data['OrganizationPhone'];
        $OrganizationAddressID = $data['OrganizationAddressID'];
        $OrganizationTypeID = $data['OrganizationTypeID'];
        $OrganizationWebsite = $data['OrganizationWebsite'];

        $organization = Organization::create_Organization(
            $OrganizationName,
            $OrganizationDescription,
            $OrganizationEmail,
            $OrganizationPhone,
            $OrganizationAddressID,
            $OrganizationTypeID,
            $OrganizationWebsite
        );

        return $organization;
    }

    // Update an existing organization
    public function updateOrganization($id, $data) {
        $organization = new Organization($id);
        $organization->OrganizationName = $data['OrganizationName'];
        $organization->OrganizationDescription = $data['OrganizationDescription'];
        $organization->OrganizationEmail = $data['OrganizationEmail'];
        $organization->OrganizationPhone = $data['OrganizationPhone'];
        $organization->OrganizationAddressID = $data['OrganizationAddressID'];
        $organization->OrganizationTypeID = $data['OrganizationTypeID'];
        $organization->OrganizationWebsite = $data['OrganizationWebsite'];

        return $organization->update();
    }

    // Delete an organization by ID
    public function deleteOrganization($id) {
        $organization = new Organization($id);
        return $organization->delete();
    }

    // Get organization by ID
    public function getOrganizationById($id) {
        // Fetch a single organization using a database query
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM Organization WHERE OrganizationID = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

// Handle POST actions outside the class
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $organizationController = new OrganizationController();
    switch ($_POST['action']) {
        case 'addOrganization':
            $data = [
                'OrganizationName' => $_POST['OrganizationName'],
                'OrganizationDescription' => $_POST['OrganizationDescription'],
                'OrganizationEmail' => $_POST['OrganizationEmail'],
                'OrganizationPhone' => $_POST['OrganizationPhone'],
                'OrganizationAddressID' => $_POST['OrganizationAddressID'],
                'OrganizationTypeID' => $_POST['OrganizationTypeID'],
                'OrganizationWebsite' => $_POST['OrganizationWebsite']
            ];
            $organizationController->createOrganization($data);
            break;

        case 'updateOrganization':
            $id = $_POST['OrganizationID'];
            $data = [
                'OrganizationName' => $_POST['OrganizationName'],
                'OrganizationDescription' => $_POST['OrganizationDescription'],
                'OrganizationEmail' => $_POST['OrganizationEmail'],
                'OrganizationPhone' => $_POST['OrganizationPhone'],
                'OrganizationAddressID' => $_POST['OrganizationAddressID'],
                'OrganizationTypeID' => $_POST['OrganizationTypeID'],
                'OrganizationWebsite' => $_POST['OrganizationWebsite']
            ];
            $organizationController->updateOrganization($id, $data);
            break;

        case 'deleteOrganization':
            $id = $_POST['OrganizationID'];
            $organizationController->deleteOrganization($id);
            break;
    }
}
?>
