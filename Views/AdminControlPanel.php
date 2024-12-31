<?php
require_once '../Controllers/userController.php';
require_once '../Controllers/PrivilegeController.php';

// Instantiate the controller
$controller = new UserController();
$users = $controller->getAllUsers();
$controllerprivilleges = new PrivilegeController();
$privileges = $controllerprivilleges->get_all_privileges();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Management Platform</title>
    <link rel="stylesheet" href="./Style/style_control_panel.css">
</head>
<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
        <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
        <a href="PrivilegesControlPanel.php">Privileges Control Panel</a>
        <a href = "OrganizationTypeControlPanel.php">Organization Type Control Panel</a>
        <a href = "BadgeAssignmentPanel.php">Badge Assignment Panel</a>
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
        <h1>user Management Platform</h1>
        <h2>Add New user</h2>

        <form id="userForm" action="AdminControlPanel.php" method="post">
            <input type="hidden" name="action" value="addUserAnduser">
            
            <div class="form-group">
            <label for="UserType">User Type</label>
            <select class="form-control" id="UserType" name="UserType" required>
                <option value="admin">Admin</option>
                <option value="volunteer">Volunteer</option>
                <option value="organization">Organization</option>
            </select>
            </div>
            <!-- User Information -->
            <div class="form-group">
                <label for="FirstName">First Name</label>
                <input type="text" id="FirstName" name="FirstName" required>
            </div>

            <div class="form-group">
                <label for="LastName">Last Name</label>
                <input type="text" id="LastName" name="LastName" required>
            </div>

            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" required>
            </div>

            <div class="form-group">
                <label for="PhoneNumber">Phone Number</label>
                <input type="tel" id="PhoneNumber" name="PhoneNumber" required>
            </div>

            <div class="form-group">
                <label for="DateOfBirth">Date of Birth</label>
                <input type="date" id="DateOfBirth" name="DateOfBirth" required>
            </div>

            <!-- Account Information -->
            <div class="form-group">
                <label for="USER_NAME">Username</label>
                <input type="text" id="USER_NAME" name="USER_NAME">
            </div>

            <div class="form-group">
                <label for="PASSWORD_HASH">Password</label>
                <input type="password" id="PASSWORD_HASH" name="PASSWORD_HASH">
            </div>


            <h3>Privileges</h3>
<div class="form-group">
    <label>Select Privileges</label>
    <?php
    for ($i = 0; $i < count($privileges); $i++) {
        echo '<div>';
        echo '<label><input type="checkbox" name="Privileges[]" value="' . $privileges[$i]->PrivilegeName . '"> ' . $privileges[$i]->Description . '</label>';
        echo '</div>';
    }
    ?>
</div>
            <button type="submit" class="button">Add user</button>
        </form>

       
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit user</h2>

        <form id="edituserForm" action = "AdminControlPanel.php" method="post">

        <input type="hidden" name="action" value="updateuser">
            <input type="hidden" id="edit" name="UserID">

            <div>
            <label for="editUserType">User Type</label>
            <select class="form-control" id="editUserType" name="UserTypeDisplay" disabled>
                <option value="admin">Admin</option>
                <option value="volunteer">Volunteer</option>
                <option value="organization">Organization</option>
            </select>
            <input type="hidden" id="editUserTypeHidden" name="UserType">
            </div>
                        
            <div class="form-group">
                <label for="editFirstName">First Name</label>
                <input type="text" id="editFirstName" name="FirstName" required>
            </div>
            
            <div class="form-group">
                <label for="editLastName">Last Name</label>
                <input type="text" id="editLastName" name="LastName" required>
            </div>
            
            <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" name="Email" required>
            </div>
            
            <div class="form-group">
                <label for="editPhoneNumber">Phone Number</label>
                <input type="tel" id="editPhoneNumber" name="PhoneNumber" required>
            </div>
            
            <div class="form-group">
                <label for="editDateOfBirth">Date of Birth</label>
                <input type="date" id="editDateOfBirth" name="DateOfBirth" required>
            </div>
            
            <div class="form-group">
                <label for="editUserName">Username</label>
                <input type="text" id="editUserName" name="USER_NAME">
            </div>
            
            <div class="form-group">
                <label for="editPasswordHash">Password</label>
                <input type="password" id="editPasswordHash" name="PASSWORD_HASH">
            </div>
    

    

            

<!-- Privilege Selection (Edit User Modal) -->
<div class="form-group">
    <label>Select Privileges</label>
    <?php
    foreach ($privileges as $privilege) {
        echo '<div>';
        echo '<label><input type="checkbox" name="Privileges[]" value="' . $privilege->PrivilegeName . '"> ' . $privilege->Description . '</label>';
        echo '</div>';
    }

    ?>
</div>
            
            
            <button type="submit" class="button" onclick="closeModal()">Save Changes</button>
        </form>
    </div>
</div>



        <!-- CRUD Table -->
        <h2>Manage users</h2>
        <table class="crud-table">
            <thead>
                <tr>
                    <th>User Type</th>
                    <th>ID</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th> Date of Birth</th>
                    <th>Privilege</th>
                    
                    
                </tr>
            </thead>
            <tbody>
    <?php foreach ($users as $user): ?>
        <tr data-id="<?= $user->UserID; ?>">
        <td class="UserType"><?= $user->UserType; ?></td>
        <td class="userId"><?= $user->UserID; ?></td>
        <td class= "firstName"><?= $user->FirstName; ?></td>
        <td class="lastName"><?= $user->LastName; ?></td>
        <td class="email"><?= $user->Email; ?></td>    
        <td class="phone"><?= $user->PhoneNumber; ?></td>
        <td class="dob"><?= $user->DateOfBirth; ?></td>

        <td class="privilege">
            <!-- convert the names of privileges array objects to a string separated by comma -->
            <?= implode(', ', array_map(fn($privilege) => $privilege->PrivilegeName, $user->getPrivileges())); ?>

        </td>


        <td>
            <button type="button" onclick="openModal(<?= $user->UserID; ?>, '<?= $user->FirstName; ?>', '<?= $user->LastName; ?>', '<?= $user->Email; ?>', '<?= $user->PhoneNumber; ?>', '<?= $user->DateOfBirth; ?>', '<?= $user->USER_NAME; ?>', '<?= $user->PASSWORD_HASH; ?>','<?= implode(', ', array_map(fn($privilege) => $privilege->PrivilegeName, $user->getPrivileges()));  ?>' ,'<?= $user->UserType; ?>' )">Edit</button>
            <form method="POST" action="AdminControlPanel.php" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
            <input type="hidden" name="action" value="deleteuser">
            <input type="hidden" name="UserID" value="<?= $user->UserID; ?>">
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
    // Function to open the modal and populate the form fields
    function openModal(userId, firstName, lastName, email, phoneNumber, dateOfBirth, userName, passwordHash, privileges, UserType) {
    console.log(userId, firstName, lastName, email, phoneNumber, dateOfBirth, userName, passwordHash, privileges, UserType);

    const formattedDate = new Date(dateOfBirth).toISOString().split('T')[0];

    // Temporarily remove 'disabled' to set the value
    const userTypeSelect = document.getElementById("editUserType");
    userTypeSelect.disabled = false; 
    userTypeSelect.value = UserType;
    userTypeSelect.disabled = true; // Reapply 'disabled'
    

    // Update the hidden input
    document.getElementById("editUserTypeHidden").value = UserType;

    // Set other values to the modal form
    document.getElementById("edit").value = userId;
    document.getElementById("editFirstName").value = firstName;
    document.getElementById("editLastName").value = lastName;
    document.getElementById("editEmail").value = email;
    document.getElementById("editPhoneNumber").value = phoneNumber;
    document.getElementById("editDateOfBirth").value = formattedDate;
    document.getElementById("editUserName").value = userName;
    document.getElementById("editPasswordHash").value = passwordHash;

    // Set checkboxes for Privileges
    const privilegeArray = privileges.split(',').map(priv => priv.trim());
    document.querySelectorAll('.form-group input[type="checkbox"]').forEach((checkbox) => {
        checkbox.checked = privilegeArray.includes(checkbox.value);
    });

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
document.getElementById('userForm').addEventListener('submit', function (event) {
    const privileges = document.querySelectorAll('input[name="Privileges[]"]:checked');
    if (privileges.length === 0) {
        alert('Please select at least one privilege.');
        event.preventDefault();
    }
});

</script>
