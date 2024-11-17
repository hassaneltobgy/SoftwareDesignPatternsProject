<?php
require_once '../Controllers/LoginController.php';
$controller = new LoginController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Management</title>
    <link rel="stylesheet" href="./Style/style_login.css">
    <script>
        // Function to handle form submission

        function setProviderLogin(provider) {
            document.getElementById('provider').value = provider;
            document.getElementById('login').submit();
            setTimeout(() => {
        showMessageModal('Logged in  successfully using ' + provider + '. Welcome!');
    }, 500); 
        }
        function setProviderSignup(provider) {
            document.getElementById('provider').value = provider;
            document.getElementById('signup').submit();
            setTimeout(() => {
        showMessageModal('Account created successfully using ' + provider + '. Welcome!');
    }, 500);             
        }

        function handleSignUpSubmit(event, provider) {
            event.preventDefault();
            const accountCreationDate = new Date().toISOString().slice(0, 10);
            document.getElementById('accountCreationDate').value = accountCreationDate;

            const userType = document.getElementById('user_type').value;
            if (!userType) {
                alert("Please select a user type.");
                return;
            }

        
            document.getElementById('signup').submit();
            setTimeout(() => {
        showMessageModal('Account created successfully using ' + provider + '. Welcome!');
    }, 500); 
        }

        function handleLoginSubmit(event, provider) {
            event.preventDefault();
            document.getElementById('login').submit();
            
            showMessageModal('Login successful with ' + provider + '. Welcome!');
        }

        // Function to toggle form fields based on user type
        function toggleFields() {
            const userType = document.getElementById('user_type').value;
            console.log(`User Type selected: ${userType}`);
            // Add logic here if fields should change dynamically based on user type
        }

        // Show specific form (login or signup)
        function showForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');

            if (formType === 'login') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else if (formType === 'signup') {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            }
        }

        // Show modal with a message
        function showMessageModal(message) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('messageModal').style.display = 'flex';
        }

        // Close the modal and redirect based on user type
        function closeMessageModal() {
            setTimeout(() => {
        const userType = document.getElementById('user_type').value;
        document.getElementById('messageModal').style.display = 'none';

        if (userType === 'Volunteer') {
            window.location.href = 'VolunteerView.php';
        } else if (userType === 'Admin') {
            window.location.href = 'AdminDashboard.php';
        }
    }, 5000); // Delay of 5000 milliseconds (5 seconds)
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

    <!-- Sign-Up Form -->
    <div id="signupForm" class="form-container hidden">
        <h2>Sign Up</h2>
        <form method="post" id="signup" action = "../Controllers/LoginController.php" >
            <input type="hidden" name="action" value="signup">
            <input type="hidden" id="accountCreationDate" name="ACCOUNT_CREATION_DATE" value="">
            

            <select id="user_type" name="user_type" onchange="toggleFields()" required>
                <option value="">Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="Volunteer">Volunteer</option>
            </select>

            <div id="commonFields">
                <input type="text" id="FirstName" name="FirstName" placeholder="First Name" required>
                <input type="text" id="LastName" name="LastName" placeholder="Last Name" required>
                <input type="email" id="Email" name="Email" placeholder="Email" required>
                <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Phone Number" required>
                <input type="date" id="DateOfBirth" name="DateOfBirth" placeholder="Date of Birth" required>
                <input type="text" id="USER_NAME" name="USER_NAME" placeholder="Username" required>
                <input type="password" id="PASSWORD_HASH" name="PASSWORD_HASH" placeholder="Password" required>
                <input type="hidden" id="provider" name="provider" value="">
            </div>

            <button type="submit" onclick="handleSignUpSubmit(event, 'Email')">Sign Up</button>
        </form>
        <hr>
        <p>Or sign up with:</p>
        <div class="social-login-buttons">
            <button class="google-btn" onclick="handleSignUpSubmit(event, 'google')">
                <img src="./assets/R (1).png" alt="Google Icon"> Sign up with Google
            </button>
            <button class="facebook-btn" onclick="handleSignUpSubmit(event, 'Facebook')">
                <img src="./assets/R.png" alt="Facebook Icon"> Sign up with Facebook
            </button>
        </div>
    </div>

    <!-- Login Form -->
    <div id="loginForm" class="form-container hidden">
        <h2>Login</h2>
        <form method="post" id="login" action = "../Controllers/LoginController.php"  >
        <input type="hidden" name="action" value="login">    
        <input type="text" id="email" name="email" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" onclick="handleLoginSubmit(event, 'Email')">Login</button>

            <input type="hidden" id="provider" name="provider" value="">

            <hr>
            <p>Or log in with:</p>
            <div class="social-login-buttons">
                <button class="google-btn" onclick="handleLoginSubmit(event, 'Google')">
                    <img src="./assets/R (1).png" alt="Google Icon"> Log in with Google
                </button>
                <button class="facebook-btn" onclick="handleLoginSubmit(event, 'Facebook')">
                    <img src="./assets/R.png" alt="Facebook Icon"> Log in with Facebook
                </button>
        </form>
    </div>

    <!-- Modal for messages -->
    <div id="messageModal" class="modal-overlay hidden">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <button onclick="closeMessageModal()">Close</button>
        </div>
    </div>
</body>
</html>
