<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organization Dashboard</title>
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
            const content = document.querySelector('.content');
            const externalButton = document.getElementById('external-toggle');
            
            sidebar.classList.toggle('visible');
            content.classList.toggle('shifted');
            externalButton.style.display = sidebar.classList.contains('visible') ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <!-- External Toggle Button to Open Sidebar -->
    <button id="external-toggle" class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Internal Toggle Button to Close Sidebar -->
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h2>Organization Dashboard</h2>
        <a href="events.php">Events</a>
        <a href="reports.php">Reports</a>
        <a href="messages.php">Messages</a>
        <!-- <a href="profile.php">Profile</a> -->
        <a href="EventManagement.php">Event Management</a>

    </div>

    <!-- Header -->
    <header>
        <h1>Welcome, Organization!</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- Content -->
    <div class="content">
        <main>
            <h1>Organization Dashboard</h1>
            <p>Here you can manage events, view reports, and communicate with volunteers.</p>

            <div class="dummy-data">
                <h2>Upcoming Events</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Event Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>Community Clean-Up</td>
                            <td>11th Nov 2024</td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Food Drive</td>
                            <td>15th Nov 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
