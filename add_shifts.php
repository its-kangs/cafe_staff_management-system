<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Admin - Add Shift</title>
</head>
<body>
    <div class="container">
        <h1>✚ Define New Shift</h1>
       <p><a href="staff_list.php">← Back to Dashboard</a> | <a href="logout_handler.php">Logout</a></p>
        <?php 
        if (isset($error) && !empty($error)) { 
        ?>
            <p class="error-message">Error: <?php echo htmlspecialchars($error); ?></p>
        <?php 
        } 
        ?>

        <form method="POST" action="add_shift_handler.php"> 
            <label for="name">Shift Name (e.g., Late Night):</label>
            <input type="text" id="name" name="name" required>

            <label for="start_time">Start Time (e.g., 18:00):</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">End Time (e.g., 22:00):</label>
            <input type="time" id="end_time" name="end_time" required>

            <button type="submit">Create Shift</button>
        </form>
    </div>

    <style>
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="time"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .error-message { color: red; background-color: #fee; padding: 10px; border: 1px solid red; border-radius: 4px; }
        button { background-color: #5C4033; color: white; cursor: pointer; padding: 12px; border: none; border-radius: 4px; }
    </style>
</body>
</html>