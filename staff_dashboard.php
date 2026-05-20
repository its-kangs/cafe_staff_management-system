<?php


require 'auth_guard.php'; 


$shifts = [];


$query = "
    SELECT 
        s.schedule_date, sh.shift_name, sh.start_time, sh.end_time
    FROM 
        schedules s
    JOIN 
        shifts sh ON s.shift_id = sh.shift_id
    WHERE 
        s.staff_id = ?
    ORDER BY s.schedule_date ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $shifts[] = $row;
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Staff Dashboard</title>
</head>
<body>
    <div class="container" style="max-width: 700px;">
        <h1>👋 Welcome Back! (Staff View)</h1>
        <p>Your current login ID is: **<?php echo htmlspecialchars($userId); ?>**.</p> 
        
        <p class="success-message">This is your personal schedule. Check here for updates!</p>
        
        <p><a href="logout_handler.php">Logout</a></p> 

        <h2 style="margin-top: 30px;">🗓️ Your Upcoming Shifts</h2>
        
        <?php if (!empty($shifts)): ?>
            <table>
                <thead> 
                    <tr>
                        <th>Date</th>
                        <th>Shift Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shifts as $shift): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($shift['schedule_date']); ?></td>
                        <td><?php echo htmlspecialchars($shift['shift_name']); ?></td>
                        <td><?php echo htmlspecialchars(substr($shift['start_time'], 0, 5)); ?></td>
                        <td><?php echo htmlspecialchars(substr($shift['end_time'], 0, 5)); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="font-style: italic; color: var(--secondary-color);">You currently have no shifts scheduled. Please check back later!</p>
        <?php endif; ?>

    </div>
</body>
</html>