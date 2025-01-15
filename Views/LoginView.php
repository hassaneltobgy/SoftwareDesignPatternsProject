<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Management</title>
    <link rel="stylesheet" href="../Views/Style/style_login.css">
    <script>
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
        <form method="post" id="signup" action="../Controllers/LoginController.php">
            <input type="hidden" name="action" value="signup">
            <input type="hidden" id="accountCreationDate" name="ACCOUNT_CREATION_DATE" value="">

            <select id="user_type" name="user_type" required>
                <option value="">Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="Volunteer">Volunteer</option>
                <option value = "Organization">Organization</option>
            </select>

            <div id="commonFields">
                <input type="text" id="FirstName" name="FirstName" placeholder="First Name" required>
                <input type="text" id="LastName" name="LastName" placeholder="Last Name" required>
                <input type="email" id="Email" name="Email" placeholder="Email" required>
                <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Phone Number" required>
                <input type="date" id="DateOfBirth" name="DateOfBirth" required>
                <input type="text" id="USER_NAME" name="USER_NAME" placeholder="Username" required>
                <input type="password" id="PASSWORD_HASH" name="PASSWORD_HASH" placeholder="Password" required>
            </div>

            <button type="submit">Sign Up</button>
            <button type = "submit" name="provider" value="google">Sign up with Google</button>
            <button type = "submit" name="provider" value="facebook">Sign up with Facebook</button>
        </form>
    </div>

    <!-- Login Form -->
    <div id="loginForm" class="form-container hidden">
        <h2>Login</h2>
        <form method="post" id="login" action="../Controllers/LoginController.php">
            <input type="hidden" name="action" value="login">
            <input type="text" id="email" name="email" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <button type = "submit" name="provider" value="google">Login with Google</button>
            <button type = "submit" name="provider" value="facebook">Login with Facebook</button>
        </form>
    </div>

    <!-- Redirection Logic -->
    <?php if (!empty($controller->Message)): ?>
        <script>
    console.log("Message:", "<?php echo addslashes($controller->Message); ?>");
    const message = "<?php echo addslashes($controller->Message); ?>";
    // if (message.includes("volunteer")) {
    //     window.location.href = "../Views/VolunteerMainScreen.php?message=" + message;
    // } else if (message.includes("admin")) {
    //     window.location.href = "../Views/AdminControlPanel.php?message=" + message;
    // } else if (message.includes("organization")) {
    //     window.location.href = "../Views/OrganizationMainScreen.php?message=" + message;
    // } 


</script>
    <?php endif; ?>
</body>
</html>
