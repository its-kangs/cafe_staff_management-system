<?php


require 'auth_guard.php'; 

$staffData = [];


$query = "
    SELECT 
        s.staff_id, s.first_name, s.last_name, s.phone, s.hire_date, 
        r.role_name, r.hourly_rate
    FROM 
        staff s
    JOIN 
        roles r ON s.role_id = r.role_id
    WHERE 
        s.is_active = 1
    ORDER BY s.last_name
";

$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $staffData[] = $row;
    }
}

?>
<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Admin - Staff Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>📊 Staff Management Dashboard (Admin)</h1>
        <p>Welcome, Manager. Here you can organize staff and shifts.</p>
        
        <p>
            <a href="add_shifts.php">✚ Add New Shift</a> | 
            <a href="manage_shedules.php">🗓️ Assign Shifts</a> |
            <a href="logout_handler.php">Logout</a>
        </p>

        <h2>Employee Roster</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Rate (KSH)</th>
                    <th>Hire Date</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
               
                if (isset($staffData) && is_array($staffData)) { 
                    foreach ($staffData as $staff) { 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($staff['staff_id']); ?></td>
                    <td><?php echo htmlspecialchars($staff['first_name'] . ' ' . $staff['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($staff['role_name']); ?></td>
                    <td><?php echo number_format($staff['hourly_rate'], 2); ?></td> 
                    <td><?php echo htmlspecialchars($staff['hire_date']); ?></td>
                    <td>
                        <a href="edit_shifts.php?id=<?php echo $staff['staff_id']; ?>">Edit Role</a> | 
                        <a href="delete_staff_handler.php?id=<?php echo $staff['staff_id']; ?>" 
                           onclick="return confirm('Are you sure you want to fire <?php echo htmlspecialchars($staff['first_name']); ?>?');">Fire</a>
                    </td>
                </tr>
                <?php 
                    } 
                } else {
                    
                    echo '<tr><td colspan="6">No staff members found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>