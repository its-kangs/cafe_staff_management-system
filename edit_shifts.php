<?php


require 'auth_guard.php'; 


$staffId = $_GET['id'] ?? null;
$staff = null;
$roles = [];


if (!$staffId) {
    header("Location: staff_list.php?error=" . urlencode("Staff ID not specified."));
    exit();
}


$staffQuery = "
    SELECT 
        s.staff_id, s.first_name, s.last_name, s.phone, s.hire_date, 
        s.role_id, r.role_name
    FROM 
        staff s
    JOIN 
        roles r ON s.role_id = r.role_id
    WHERE 
        s.staff_id = ? AND s.is_active = 1
";
$stmt = $conn->prepare($staffQuery);
$stmt->bind_param("i", $staffId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $staff = $result->fetch_assoc();
} else {
    
    header("Location: staff_list.php?error=" . urlencode("Staff member not found."));
    exit();
}
$stmt->close();


$rolesQuery = "SELECT role_id, role_name FROM roles ORDER BY role_name";
$rolesResult = $conn->query($rolesQuery);
if ($rolesResult) {
    while ($row = $rolesResult->fetch_assoc()) {
        $roles[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Admin - Edit Staff</title>
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h1>✏️ Edit Staff Details</h1>
        <p><a href="staff_list.php">← Back to Roster</a> | <a href="logout_handler.php">Logout</a></p>
        <?php 
        if (isset($error) && !empty($error)) { 
        ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php 
        } 
        ?>

        <form method="POST" action="edit_staff_handler.php?id=<?php echo htmlspecialchars($staff['staff_id']); ?>">
            <h2><?php echo htmlspecialchars($staff['first_name'] . ' ' . $staff['last_name']); ?> (ID: <?php echo htmlspecialchars($staff['staff_id']); ?>)</h2>
            
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($staff['first_name']); ?>" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($staff['last_name']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($staff['phone']); ?>">

            <label for="role_id">Current Role: **<?php echo htmlspecialchars($staff['role_name']); ?>**</label>
            <select id="role_id" name="role_id" required>
                <?php 
                // Loop through the $roles array
                if (isset($roles) && is_array($roles)) {
                    foreach ($roles as $role) { 
                        $selected = ($role['role_id'] === $staff['role_id']) ? 'selected' : '';
                ?>
                    <option value="<?php echo htmlspecialchars($role['role_id']); ?>" <?php echo $selected; ?>>
                        <?php echo htmlspecialchars($role['role_name']); ?>
                    </option>
                <?php 
                    } 
                } 
                ?>
            </select>
            
            <button type="submit">Update Staff Details</button>
        </form>
    </div>
</body>
</html>