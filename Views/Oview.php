<?php
require_once 'C:\Users\HP\Downloads\Phase1\Controllers\OrganizationController.php'; // Adjust path as necessary

$organizationController = new OrganizationController();
$organizations = $organizationController->getAllOrganizations();

// Display organizations
foreach ($organizations as $organization) {
    echo $organization['OrganizationName'] . "<br>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $data = [
            'OrganizationName' => $_POST['OrganizationName'],
            'OrganizationDescription' => $_POST['OrganizationDescription'],
            'OrganizationEmail' => $_POST['OrganizationEmail'],
            'OrganizationPhone' => $_POST['OrganizationPhone'],
            'OrganizationAddressID' => $_POST['OrganizationAddressID'],
            'OrganizationTypeID' => $_POST['OrganizationTypeID'],
            'OrganizationWebsite' => $_POST['OrganizationWebsite']
        ];
        $controller->createOrganization($data);
        header("Location: Oview.php");
    }

    if (isset($_POST['edit'])) {
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
        $controller->updateOrganization($id, $data);
        header("Location: Oview.php");
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['OrganizationID'];
        $controller->deleteOrganization($id);
        header("Location: Oview.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Organizations</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Manage Organizations</h1>

    <h2>Add/Edit Organization</h2>
    <form method="POST">
        <input type="hidden" name="OrganizationID" id="OrganizationID">
        <label for="OrganizationName">Name:</label>
        <input type="text" name="OrganizationName" id="OrganizationName" required><br>

        <label for="OrganizationDescription">Description:</label>
        <input type="text" name="OrganizationDescription" id="OrganizationDescription" required><br>

        <label for="OrganizationEmail">Email:</label>
        <input type="email" name="OrganizationEmail" id="OrganizationEmail" required><br>

        <label for="OrganizationPhone">Phone:</label>
        <input type="text" name="OrganizationPhone" id="OrganizationPhone" required><br>

        <label for="OrganizationAddressID">Address ID:</label>
        <input type="number" name="OrganizationAddressID" id="OrganizationAddressID" required><br>

        <label for="OrganizationTypeID">Type ID:</label>
        <input type="number" name="OrganizationTypeID" id="OrganizationTypeID" required><br>

        <label for="OrganizationWebsite">Website:</label>
        <input type="text" name="OrganizationWebsite" id="OrganizationWebsite" required><br>

        <button type="submit" name="add">Add Organization</button>
        <button type="submit" name="edit">Edit Organization</button>
    </form>

    <h2>Organizations List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address ID</th>
                <th>Type ID</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($organizations as $org): ?>
                <tr>
                    <td><?= $org['OrganizationID'] ?></td>
                    <td><?= $org['OrganizationName'] ?></td>
                    <td><?= $org['OrganizationDescription'] ?></td>
                    <td><?= $org['OrganizationEmail'] ?></td>
                    <td><?= $org['OrganizationPhone'] ?></td>
                    <td><?= $org['OrganizationAddressID'] ?></td>
                    <td><?= $org['OrganizationTypeID'] ?></td>
                    <td><?= $org['OrganizationWebsite'] ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="OrganizationID" value="<?= $org['OrganizationID'] ?>">
                            <button type="button" onclick="editOrganization(<?= htmlspecialchars(json_encode($org)) ?>)">Edit</button>
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editOrganization(org) {
            document.getElementById('OrganizationID').value = org.OrganizationID;
            document.getElementById('OrganizationName').value = org.OrganizationName;
            document.getElementById('OrganizationDescription').value = org.OrganizationDescription;
            document.getElementById('OrganizationEmail').value = org.OrganizationEmail;
            document.getElementById('OrganizationPhone').value = org.OrganizationPhone;
            document.getElementById('OrganizationAddressID').value = org.OrganizationAddressID;
            document.getElementById('OrganizationTypeID').value = org.OrganizationTypeID;
            document.getElementById('OrganizationWebsite').value = org.OrganizationWebsite;
        }
    </script>
</body>
</html>
