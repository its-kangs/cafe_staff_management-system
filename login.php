<?php

session_start();

$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Staff Login</title>
</head>
<body>
    <div class="container" style="max-width: 400px; text-align: center;">
        <h1>☕ Staff Login</h1>
        <p>Manage your shifts and payroll.</p>
        
        <?php 
        
        if (isset($error) && !empty($error)) { 
        ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php 
        } 
        ?>

        <form method="POST" action="login_handler.php">
            <label for="username" style="display: block; text-align: left; font-weight: 600;">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Enter your username">
            
            <label for="password" style="display: block; text-align: left; font-weight: 600;">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            
            <button type="submit">Log In</button>
        </form>
        
        <p>New staff member? <a href="registration.php">Register Here</a></p>
    </div>
</body>
</html>