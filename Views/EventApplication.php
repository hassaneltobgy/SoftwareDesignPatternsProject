<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Applications</title>
    <style>
body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2a3d4d;
            color: white;
            position: fixed;
            top: 0;
            left: -250px; /* Hidden initially */
            transition: left 0.3s ease;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar.visible {
            left: 0; /* Slide in */
        }
        .sidebar h2 {
            text-align: center;
            margin: 0 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 16px;
            display: block;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #22303d;
        }
        .toggle-btn {
            background-color: #2a3d4d;
            color: white;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
            border-radius: 5px;
            position: absolute;
            top: 5px;
            left: 10px;
            z-index: 1100;
            font-size: 18px;
        }
        .toggle-btn:hover {
            background-color: #22303d;
        }
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease; /* Smooth content shift */
        }
        .content.shifted {
            margin-left: 250px; /* Shifted when sidebar is visible */
        }
        header {
            background-color: #2a3d4d;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        header h1 {
            margin: 0;
            font-size: 18px;
            padding-left: 50px; /* Adjust padding to avoid overlap */
        }
        header nav a {
            color: white;
            text-decoration: none;
            padding: 5px 5px;
        }
        .dummy-data {
            margin-top: 20px;
        }
        .dummy-data h2 {
            color: #2a3d4d;
        }
        .dummy-data table {
            width: 100%;
            border-collapse: collapse;
        }
        .dummy-data th, .dummy-data td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        .dummy-data th {
            background-color: #2a3d4d;
            color: white;
        }
    </style>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('visible');
            const content = document.querySelector('.content');
            content.classList.toggle('shifted');
        }
    </script>
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Volunteer Dashboard</h2>
        <a href="volunteerView.php">Home</a>
        <a href="event_application.php">Event Application</a>
        <a href="applications.php">Applications</a>
        <a href="profile.php">Profile</a>
    </div>

    <header>
        <h1>Event Applications</h1>
        <nav><a href="home.php">Logout</a></nav>
    </header>

    <div class="content">
        <div class="dummy-data">
            <h2>Your Event Applications</h2>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Annual Food Drive</td>
                        <td>12th Nov 2024</td>
                        <td>Pending</td>
                        <td class="actions">
                            <button onclick="withdrawApplication()">Withdraw</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Charity Run</td>
                        <td>8th Nov 2024</td>
                        <td>Accepted</td>
                        <td class="actions">
                            <!-- No action for accepted applications -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
