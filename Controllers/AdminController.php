<?php
require_once 'C:\Users\HP\Downloads\Phase1\Models\AdminModel.php';

class AdminController {
    // Display the admin dashboard view
    public function displayDashboard() {
        include "adminDashboardView.php";
    }

    // Handle adding a new admin
    public function addAdmin($data) {
        $result = Admin::addAdmin(
            $data['FirstName'],
            $data['LastName'],
            $data['Email'],
            $data['PhoneNumber'],
            $data['USER_NAME'],
            password_hash($data['Password'], PASSWORD_DEFAULT),
            $data['UserTypeID']
        );
        if ($result) {
            echo "Admin added successfully.";
        } else {
            echo "Error adding admin.";
        }
    }

    // Handle updating admin
    public function updateAdmin($adminId, $data) {
        $admin = new Admin($adminId);
        $admin->FirstName = $data['FirstName'];
        $admin->LastName = $data['LastName'];
        $admin->Email = $data['Email'];
        $admin->PhoneNumber = $data['PhoneNumber'];
        $admin->USER_NAME = $data['USER_NAME'];
        $admin->UserTypeID = $data['UserTypeID'];
        $admin->UpdateAdmin();
    }

    // Handle deleting an admin
    public function deleteAdmin($adminId) {
        $admin = new Admin();
        $admin->removeAdmin($adminId);
    }

    // Get a list of all admins
    public function listAdmins() {
        $query = "SELECT * FROM Admin";
        $conn = Database::getInstance()->getConnection();
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
