<?php
// assign_shift_handler.php - UPDATED TO USE SP_AssignStaffShift
require 'auth_guard.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffId = $_POST['staff_id'] ?? null;
    $shiftId = $_POST['shift_id'] ?? null;
    $scheduleDate = $_POST['schedule_date'] ?? null;
    
    if (empty($staffId) || empty($shiftId) || empty($scheduleDate)) {
        $error = "All fields must be selected.";
        header("Location: manage_shedules.php?error=" . urlencode($error));
        exit();
    }

    try {
        // 1. Check for duplicate assignment (same staff on the same day)
        // NOTE: We keep this check here as it is client-side logic/error handling.
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM schedules WHERE staff_id = ? AND schedule_date = ?");
        $checkStmt->bind_param("is", $staffId, $scheduleDate);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result()->fetch_row();
        $checkStmt->close();

        if ($checkResult[0] > 0) {
            $error = "Error: Staff member is already assigned a shift on this date. Cannot assign duplicate.";
            header("Location: manage_shedules.php?error=" . urlencode($error));
            exit();
        }

        // 2. CRITICAL UPDATE: Insert the new shift assignment using the Stored Procedure
        $insertStmt = $conn->prepare("CALL SP_AssignStaffShift(?, ?, ?)");
        $insertStmt->bind_param("iis", $staffId, $shiftId, $scheduleDate);
        
        if ($insertStmt->execute()) {
            $message = "Shift successfully assigned for " . htmlspecialchars($scheduleDate) . " using Stored Procedure.";
            header("Location: manage_shedules.php?message=" . urlencode($message));
            exit();
        } else {
            $error = "Database error: " . $conn->error;
            header("Location: manage_shedules.php?error=" . urlencode($error));
            exit();
        }
        $insertStmt->close();

    } catch (Exception $e) {
        error_log("Assign Shift Error: " . $e->getMessage());
        $error = "An unexpected server error occurred.";
        header("Location: manage_shedules.php?error=" . urlencode($error));
        exit();
    }
}
?>