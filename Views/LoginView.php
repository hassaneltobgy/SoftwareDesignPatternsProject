

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
                <input type="text" id="FirstName" name="FirstName" placeholder="First Name" >
                <input type="text" id="LastName" name="LastName" placeholder="Last Name" >
                <input type="email" id="Email" name="Email" placeholder="Email" >
                <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Phone Number" >
                <input type="date" id="DateOfBirth" name="DateOfBirth" >
                <input type="text" id="USER_NAME" name="USER_NAME" placeholder="Username" >
                <input type="password" id="PASSWORD_HASH" name="PASSWORD_HASH" placeholder="Password" >
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
            <input type="text" id="email" name="email" placeholder="Username" >
            <input type="password" id="password" name="password" placeholder="Password" >
            <button type="submit">Login</button>
            <button type = "submit" name="provider" value="google">Login with Google</button>
            <button type = "submit" name="provider" value="facebook">Login with Facebook</button>
        </form>
    </div>

    <!-- Redirection Logic -->
    <?php if (!empty($controller->Message)): ?>
        <script>
    console.log("Message isss:", "<?php echo addslashes($controller->Message); ?>");
    const message = "<?php echo addslashes($controller->Message); ?>";
        // get the word after email is and assign it to email
    
    
    

    if (message.includes("Google")) {
        const url = message.match(/url is (.*)/)[1];
        window.location.href = url ;
    } 
    else if (message.includes("admin") || message.includes("Admin")) {

        alert(message);
        const email = message.match(/Email is (.*)/)[1];
        window.location.href = "../Views/AdminControlPanel.php?message=" + message;
    } else if (message.includes("organization") || message.includes("Organization")) {

        alert(message);
        const email = message.match(/Email is (.*)/)[1];
        window.location.href = "../Views/OrganizationMainScreen.php?message=" + message;
    } 
    else if (message.includes("volunteer") || message.includes("Volunteer")) {
        alert(message);
        const email = message.match(/Email is (.*)/)[1];
        window.location.href = "../Views/VolunteerProfileView.php?message=" + message + "&email=" + email;

    }
  


</script>
    <?php endif; ?>
</body>
</html>
