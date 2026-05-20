<?php

session_start();

$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Staff Registration</title>
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h1>📝 Staff Registration</h1>
        <p>Create your new account to access the scheduling system.</p>

        <?php 
        
        if (isset($error) && !empty($error)) { 
        ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php 
        } 
        ?>

        <form method="POST" action="register_handler.php">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required placeholder="First Name">

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required placeholder="Last Name">

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Phone Number (Optional)">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Choose a unique username">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Choose a password">
            
            <button type="submit">Register Account</button>
        </form>
        
        <p style="text-align: center;"><a href="login.php">Already have an account? Log In</a></p>
    </div>
</body>
</html>