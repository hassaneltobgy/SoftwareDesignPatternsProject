<?php
require_once '../Controllers/VolunteerController.php';
require_once '../Controllers/BadgeController.php';

// Instantiate the controller
$controller = new VolunteerController();
$volunteers = $controller->get_all_Volunteers();
$badgeController = new BadgeController();
$badges = $badgeController->get_all_Badges();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badge Assignment Management</title>
    <link rel="stylesheet" href="./Style/style_control_panel.css">
</head>
<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <span href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</span>
    <a href="AdminControlPanel.php">Admin Control Panel</a>
    <a href="PrivilegesControlPanel.php">Priviliges Control Panel</a>
    <a href="OrganizationTypeControlPanel.php">Organization Type Control Panel</a>
    <a href="LoginView.php" onclick="logout()">Logout</a>
</div>
<span class="open-btn" onclick="openNav()">&#9776;</span> <!-- Hamburger icon to open sidebar -->

<script>
function openNav() {
    document.getElementById("mySidebar").style.left = "0";
    const container = document.querySelector('.container');
    container.style.marginLeft = "250px";
    container.style.width = "calc(100% - 250px)";
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease";
}

function closeNav() {
    document.getElementById("mySidebar").style.left = "-250px";
    const container = document.querySelector('.container');
    container.style.marginLeft = "auto";
    container.style.width = "80%";
    container.style.transition = "margin-left 0.3s ease, width 0.3s ease";
}

function logout() {
    window.location.href = 'LoginView.php';
}
</script>

<div class="container">
    <h1>Badge Assignment Management Platform</h1>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit BadgeAssignment</h2>

            <form id="editBadgeAssignmentForm" action="BadgeAssignmentPanel.php" method="post">
                <input type="hidden" name="action" value="updateBadgeAssignment">
                <input type="hidden" id="edit" name="BadgeAssignmentID">

                <input type="hidden" id="editVolunteerID" name="VolunteerID">

                <div class="form-group">
                    <label for="editVolunteerName">Volunteer Name</label>
                    <input type="text" id="editVolunteerName" name="VolunteerName" disabled>
                </div>

                <div class="form-group">
                    <label for="editBadgeName">Badge Name</label>
                    <select id="editBadgeName" name="BadgeName" required>
                        <?php foreach ($badges as $badge_id => $badge) : ?>
                            <option value="<?= $badge['title']; ?>"><?= $badge['title']; ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <button type="submit" class="button">Save Changes</button>
            </form>
        </div>
    </div>

    <h2>Manage BadgeAssignments</h2>
    <table class="crud-table">
        <thead>
            <tr>
                <th>Volunteer Name</th>  
                <th>Badge Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($volunteers as $volunteer) : ?>
                    <tr>
                        <td><?= $volunteer->FirstName; ?></td>
                        <td><?= $volunteer->badge->get_title(); ?></td>
                        <td>
                    
        
                            <button class="button" onclick="openModal(<?=$controller->getBadgeIdByName($volunteer->badge->get_title()); ?>, '<?= $volunteer->badge->get_title(); ?>', '<?= $volunteer->FirstName; ?>','<?= $volunteer->VolunteerID; ?>')">Edit</button>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function openModal(badge_id, BadgeName, VolunteerName, VolunteerID) {
    console.log(badge_id, BadgeName, VolunteerName, VolunteerID);
    const modal = document.getElementById("editModal");
    if (modal) {
        modal.style.display = "block";
        document.getElementById("edit").value = badge_id;
        document.getElementById("editVolunteerName").value = VolunteerName;
        document.getElementById("editVolunteerID").value = VolunteerID;  // Set VolunteerID

        // Loop through all options in the Badge dropdown and set the selected option
        const badgeSelect = document.getElementById("editBadgeName");
        for (let i = 0; i < badgeSelect.options.length; i++) {
            const option = badgeSelect.options[i];
            console.log(option.value, badge_id);
            if (option.value == BadgeName) {
                option.selected = true; // Set the corresponding badge as selected
                break;
            }
        }
    } else {
        console.error('Modal not found.');
    }
}


function closeModal() {
    const modal = document.getElementById("editModal");
    if (modal) {
        modal.style.display = "none";
    } else {
        console.error('Modal not found.');
    }
}
</script>

</body>
</html>
