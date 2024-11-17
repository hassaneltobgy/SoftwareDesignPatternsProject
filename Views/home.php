<?php
$error = "";
$signupError = "";

// Handle login
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic input validation
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Dummy login validation (replace with actual authentication logic)
        if ($email === "volunteer@example.com" && $password === "password") {
            header("Location: volunteerView.php");
            exit();
        } elseif ($email === "org@example.com" && $password === "password") {
            header("Location: organizationView.php");
            exit();
        } elseif ($email === "admin@example.com" && $password === "password") {  // Admin login
            header("Location: adminView.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}

// Handle signup
if (isset($_POST['action']) && $_POST['action'] == 'signup') {
    $userType = $_POST['user_type'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic input validation for sign-up
    if (empty($userType) || empty($email) || empty($password)) {
        $signupError = "All fields are required.";
    } else {
        // Dummy signup handling based on user type
        if ($userType === "volunteer") {
            header("Location: volunteerView.php");
        } elseif ($userType === "organization") {
            header("Location: organizationView.php");
        } elseif ($userType === "admin") {  // Admin signup
            header("Location: adminView.php");
        }
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Civic Connect - Volunteer Management</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        header {
            background-color: #2a3d4d;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        header .nav-buttons {
            display: flex;
            gap: 10px;
        }
        .nav-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .nav-buttons .login-btn {
            background-color: #337ab7;
            color: white;
        }
        .nav-buttons .signup-btn {
            background-color: #5bc0de;
            color: white;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex: 1;
            padding: 40px;
            background-color: #eef2f7;
        }
        .main-content h1 {
            font-size: 36px;
            color: #2a3d4d;
            margin: 20px 0;
        }
        .main-content p {
            font-size: 18px;
            color: #555;
            max-width: 600px;
        }

        /* Form Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .form-container {
            width: 300px;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .form-container button:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
    <script>
        function showForm(formType) {
            const overlay = document.getElementById('modalOverlay');
            overlay.style.display = 'flex';

            if (formType === 'login') {
                document.getElementById('loginForm').style.display = 'block';
                document.getElementById('signupForm').style.display = 'none';
            } else {
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('signupForm').style.display = 'block';
            }
        }

        function closeForm() {
            document.getElementById('modalOverlay').style.display = 'none';
        }

        function toggleFields() {
            const userType = document.getElementById('user_type').value;
            document.getElementById('volunteerFields').style.display = userType === 'volunteer' ? 'block' : 'none';
            document.getElementById('organizationFields').style.display = userType === 'organization' ? 'block' : 'none';
        }
    </script>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">Volunteer Connect</div>
        <nav class="nav-buttons">
            <button class="login-btn" onclick="showForm('login')">Login</button>
            <button class="signup-btn" onclick="showForm('signup')">Sign Up</button>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to Volunteer Connect</h1>
        <p>Volunteer management software designed to make an impact. Easily recruit, engage, and retain volunteers with Volunteer Connect.</p>
    </div>

    <!-- Modal Overlay -->
    <div id="modalOverlay" class="modal-overlay" onclick="closeForm()">
        <!-- Login Form -->
        <div id="loginForm" class="form-container" onclick="event.stopPropagation()">
            <h2>Login</h2>
            <form method="post" action="">
                <input type="hidden" name="action" value="login">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            </form>
        </div>

        <!-- Signup Form -->
        <div id="signupForm" class="form-container" style="display: none;" onclick="event.stopPropagation()">
            <h2>Sign Up</h2>
            <form method="post" action="">
                <input type="hidden" name="action" value="signup">
                <select id="user_type" name="user_type" onchange="toggleFields()" required>
                    <option value="">Select User Type</option>
                    <option value="volunteer">Volunteer</option>
                    <option value="organization">Organization</option>
                    
                </select>

                <div id="volunteerFields" style="display:none;">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div id="organizationFields" style="display:none;">
                    <input type="text" name="organization_name" placeholder="Organization Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Sign Up</button>
                <?php if (!empty($signupError)) echo "<p class='error'>$signupError</p>"; ?>
            </form>
        </div>
    </div>

</body>
</html>
