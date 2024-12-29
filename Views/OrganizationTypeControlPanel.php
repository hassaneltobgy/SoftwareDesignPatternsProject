<?php
require_once '../Controllers/OrganizationTypeController.php';

// Instantiate the controller
$controller = new OrganizationTypeController();
$OrganizationTypes = $controller->get_all_OrganizationTypes();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Type Management</title>
    <link rel="stylesheet" href="./Style/style_control_panel.css">
</head>
<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
        <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
        <a href="AdminControlPanel.php">Admin Control Panel</a>
        <a href = "PrivilegesControlPanel.php">Priviliges Control Panel</a>
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
        <h1>Organization Type Management Platform</h1>
        <h2>Add New Organization Type</h2>

        <form id="userForm" action="OrganizationTypeControlPanel.php" method="post">
            <input type="hidden" name="action" value="addOrganizationType">

            
           
            <!-- User Information -->
            <div class="form-group">
                <label for="OrganizationTypeName">OrganizationType Name</label>
                <input type="text" id="OrganizationTypeName" name="OrganizationTypeName" required>
            </div>

    

            <button type="submit" class="button">Add OrganizationType</button>
        </form>


       
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit OrganizationType</h2>

        <form id="editOrganizationTypeForm" action = "OrganizationTypeControlPanel.php" method="post">

        <input type="hidden" name="action" value="updateOrganizationType">
        <input type="hidden" id="edit" name="OrganizationTypeID">
            
            <div class="form-group">
                <label for="editName">OrganizationType Name</label>
                <input type="text" id="editName" name="OrganizationTypeName" required>
            </div>
            
            
            <button type="submit" class="button" onclick="closeModal()">Save Changes</button>
        </form>
    </div>
</div>



        <!-- CRUD Table -->
        <h2>Manage OrganizationTypes</h2>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>OrganizationType Name</th>  
                    
                </tr>
            </thead>
            <tbody>
    <?php foreach ($OrganizationTypes as $OrganizationType) : ?>
        <tr>
            <td><?= $OrganizationType->OrganizationTypeName; ?></td>
        </tr>

        <td>
            <button type="button" onclick="openModal(<?= $OrganizationType->OrganizationTypeID; ?>, '<?= $OrganizationType->OrganizationTypeName; ?>')">Edit</button>
            <form method="POST" action="OrganizationTypeControlPanel.php" onsubmit="return confirm('Are you sure you want to delete this OrganizationType?');" style="display:inline;">
                <input type="hidden" name="action" value="deleteOrganizationType">
                <input type="hidden" name="OrganizationTypeID" value="<?= $OrganizationType->OrganizationTypeID; ?>">
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
    function openModal(OrganizationTypeID, OrganizationTypeName) 
    {
    console.log(OrganizationTypeID, OrganizationTypeName);


    // Set values for the form fields
    document.getElementById('edit').value = OrganizationTypeID;
    document.getElementById('editName').value = OrganizationTypeName;
    

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
