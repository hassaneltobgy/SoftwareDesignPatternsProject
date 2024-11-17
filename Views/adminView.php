<?php
require_once 'C:\Users\HP\Downloads\Phase1\Controllers\AdminController.php';


$adminController = new AdminController();
$admins = $adminController->listAdmins();

foreach ($admins as $admin) {
    echo "<tr>
            <td>{$admin['AdminId']}</td>
            <td>{$admin['Email']}</td>
            <td>{$admin['UserTypeID']}</td>
            <td>
                <button class='btn btn-edit'>Edit</button>
                <button class='btn btn-delete'>Delete</button>
            </td>
          </tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Volunteer Connect</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            display: flex;
        }

        header {
            background-color: #2a3d4d;
            padding: 10px 20px;
            color: white;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .toggle-button {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #34495e;
            color: white;
            position: fixed;
            height: 100%;
            padding-top: 60px;
            top: 0;
            left: -250px; /* Initially hidden */
            transition: left 0.3s ease; /* Slide-in transition */
        }

        .sidebar.open {
            left: 0; /* Slide-in position */
        }

        .sidebar a {
            padding: 10px;
            color: white;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #5a738e;
        }

        /* Content Styles */
        .content {
            margin-left: 0;
            padding: 20px;
            padding-top: 80px; /* To account for fixed header */
            flex: 1;
            transition: margin-left 0.3s ease; /* Smooth content shift */
        }

        /* Adjusted margin when sidebar is open */
        .content.shifted {
            margin-left: 250px;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #5bc0de;
        }

        .btn-delete {
            background-color: #d9534f;
        }
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");

            sidebar.classList.toggle("open");
            content.classList.toggle("shifted");
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header>
        <button class="toggle-button" onclick="toggleSidebar()">&#9776;</button>
        <h1 style="display:inline;">Admin Dashboard</h1>
    </header>
    
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <h2>Menu</h2>
        <a href="volunteerView.php">Volunteer View</a>
        <a href="organizationView.php">Organization View</a>
        <a href="#">User Management</a>
        <a href="index.php">Logout</a>
    </div>

    <!-- Content -->
    <div id="content" class="content">
        <h2>User Management</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data row -->
                    <tr>
                        <td>1</td>
                        <td>volunteer@example.com</td>
                        <td>Volunteer</td>
                        <td>
                            <button class="btn btn-edit">Edit</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <!-- Add PHP code here to dynamically list all users -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
