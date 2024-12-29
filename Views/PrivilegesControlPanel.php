<?php
require_once '../Controllers/PrivilegeController.php';

// Instantiate the controller
$controller = new PrivilegeController();
$privileges = $controller->get_all_privileges();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privilege Management</title>
    <link rel="stylesheet" href="./Style/style_control_panel.css">
</head>
<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
        <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
        <a href="AdminControlPanel.php">Admin Control Panel</a>
        <a href = "OrganizationTypeControlPanel.php">Organization Type Control Panel</a>
        <a href="LoginView.php" onclick="logout()">Logout</a>
    </div>
    <span class="open-btn" onclick="openNav()">&#9776;</span> <!-- Hamburger icon to open sidebar -->
   
    <script>
 function openNav() {
    // Move sidebar into view
    document.getElementById("mySidebar").style.left = "0";
    // Adjust the container to account for the sidebar
    const container = document.querySelector('.container');
    container.style.marginLeft = "250px";
    container.style.width = "calc(100% - 250px)"; // Dynamically adjust width
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease"; // Smooth transition
}
function closeNav() {
    // Hide the sidebar
    document.getElementById("mySidebar").style.left = "-250px";
    // Reset container position and width
    const container = document.querySelector('.container');
    container.style.marginLeft = "auto";
    container.style.width = "80%"; // Reset to centered layout width
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease"; // Smooth transition
}
function logout() {
    window.location.href = 'LoginView.php'; // Redirect to login page
}
</script>
    <div class="container">
        <h1>Privilege Management Platform</h1>
        <h2>Add New Privilege</h2>

        <form id="userForm" action="PrivilegesControlPanel.php" method="post">
            <input type="hidden" name="action" value="addPrivilege">

            
           
            <!-- User Information -->
            <div class="form-group">
                <label for="PrivilegeName">Privilege Name</label>
                <input type="text" id="PrivilegeName" name="PrivilegeName" required>
            </div>

        

            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" id="Description" name="Description" required>
            </div>

    
            <div class="form-group">
                <label for="AccessLevel">Access Level</label>
                <!-- access level is a number between 0 and 4 -->
                <input type="number" id="AccessLevel" name="AccessLevel" min="0" max="4" required>
            </div>

            <button type="submit" class="button">Add Privilege</button>
        </form>


       
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Privilege</h2>

        <form id="editprivilegeForm" action = "PrivilegesControlPanel.php" method="post">

        <input type="hidden" name="action" value="updateprivilege">
        <input type="hidden" id="edit" name="PrivilegeID">
            
            <div class="form-group">
                <label for="editName">Privilege Name</label>
                <input type="text" id="editName" name="PrivilegeName" required>
            </div>
            
            <div class="form-group">
                <label for="editDescription">Description</label>
                <input type="text" id="editDescription" name="Description" required>
            </div>
          
            <div class="form-group">
                <label for="editAccessLevel">Access Level</label>
                <input type="number" id="editAccessLevel" name="AccessLevel" min="0" max="4" required>
            </div>
        
            
            
            <button type="submit" class="button" onclick="closeModal()">Save Changes</button>
        </form>
    </div>
</div>



        <!-- CRUD Table -->
        <h2>Manage privileges</h2>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>Privilege Name</th>
                    <th>Description</th>
                    <th>Access Level</th>      
                    
                </tr>
            </thead>
            <tbody>
    <?php foreach ($privileges as $privilege) : ?>
        <tr>
            <td><?= $privilege->PrivilegeName; ?></td>
            <td><?= $privilege->Description; ?></td>
            <td><?= $privilege->AccessLevel; ?></td>
        </tr>

        <td>
            <button type="button" onclick="openModal(<?= $privilege->PrivilegeID; ?>, '<?= $privilege->PrivilegeName; ?>', '<?= $privilege->Description; ?>', '<?= $privilege->AccessLevel; ?>')">Edit</button>
            <form method="POST" action="PrivilegesControlPanel.php" onsubmit="return confirm('Are you sure you want to delete this privilege?');" style="display:inline;">
                <input type="hidden" name="action" value="deleteprivilege">
                <input type="hidden" name="PrivilegeID" value="<?= $privilege->PrivilegeID; ?>">
                <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline;">Delete</button>
            </form>

        </td>
    </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>

   
</body>
</html>

<script>
    function openModal(PrivilegeID, PrivilegeName, Description, AccessLevel) 
    {
    console.log(PrivilegeID, PrivilegeName, Description, AccessLevel);


    // Set values for the form fields
    document.getElementById('edit').value = PrivilegeID;
    document.getElementById('editName').value = PrivilegeName;
    document.getElementById('editDescription').value = Description;
    document.getElementById('editAccessLevel').value = AccessLevel;

    // Show the modal
    const modal = document.getElementById("editModal");
    if (modal) {
        modal.style.display = "block";
    } else {
        console.error('Modal not found.');
    }
}




    // Function to close the modal
    function closeModal() {
    const modal = document.getElementById("editModal");
    if (modal) {
        modal.style.display = "none";
    } else {
        console.error('Modal not found.');
    }
}


</script>
