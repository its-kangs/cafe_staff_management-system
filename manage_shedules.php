<?php


require 'auth_guard.php'; 


$staffData = [];
$shiftData = [];


$staffResult = $conn->query("SELECT staff_id, first_name, last_name FROM staff WHERE is_active = 1 ORDER BY last_name");
if ($staffResult) {
    while ($row = $staffResult->fetch_assoc()) {
        $staffData[] = $row;
    }
}


$shiftResult = $conn->query("SELECT shift_id, shift_name, start_time, end_time FROM shifts ORDER BY start_time");
if ($shiftResult) {
    while ($row = $shiftResult->fetch_assoc()) {
        $shiftData[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'partials/header.php'; ?>
    <title>Admin - Assign Shifts</title>
</head>
<body>
    <div class="container">
        <h1>🗓️ Assign Staff Shifts</h1>
      <p><a href="staff_list.php">← Back to Dashboard</a> | <a href="logout_handler.php">Logout</a></p>
        <?php 
        if (isset($error) && !empty($error)) { 
        ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php 
        } 
        if (isset($message) && !empty($message)) { 
        ?>
            <p class="success-message"><?php echo htmlspecialchars($message); ?></p>
        <?php 
        } 
        ?>

        <form method="POST" action="assign_shift_handler.php">
            <h2>New Shift Assignment</h2>
            
            <label for="staff_id">Select Staff Member:</label>
            <select id="staff_id" name="staff_id" required>
                <option value="">-- Choose Staff --</option>
                <?php 
                if (isset($staffData) && is_array($staffData)) {
                    foreach ($staffData as $staff) { 
                ?>
                    <option value="<?php echo htmlspecialchars($staff['staff_id']); ?>">
                        <?php echo htmlspecialchars($staff['first_name'] . ' ' . $staff['last_name']); ?>
                    </option>
                <?php 
                    } 
                }
                ?>
            </select>

            <label for="shift_id">Select Shift:</label>
            <select id="shift_id" name="shift_id" required>
                <option value="">-- Choose Shift --</option>
                <?php 
                if (isset($shiftData) && is_array($shiftData)) {
                    foreach ($shiftData as $shift) { 
                ?>
                    <option value="<?php echo htmlspecialchars($shift['shift_id']); ?>">
                        <?php echo htmlspecialchars($shift['shift_name']); ?> 
                        (<?php echo htmlspecialchars(substr($shift['start_time'], 0, 5) . ' - ' . substr($shift['end_time'], 0, 5)); ?>)
                    </option>
                <?php 
                    } 
                }
                ?>
            </select>
            
            <label for="schedule_date">Select Date:</label>
            <input type="date" id="schedule_date" name="schedule_date" required>

            <button type="submit">Assign Shift</button>
        </form>

        <h2 style="margin-top: 40px;">Current Schedule</h2>
        <p>The schedule display feature will be built next.</p>
    </div>
</body>
</html>