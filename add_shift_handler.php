<?php
// add_shift_handler.php - UPDATED TO USE SP_AddNewShift
require 'auth_guard.php'; 

// $conn variable is available from auth_guard.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shiftName = $_POST['name'] ?? null;
    $startTime = $_POST['start_time'] ?? null;
    $endTime = $_POST['end_time'] ?? null;

    if (empty($shiftName) || empty($startTime) || empty($endTime)) {
        $error = "All fields are required to create a new shift.";
        header("Location: add_shifts.php?error=" . urlencode($error));
        exit();
    }

    try {
        // CRITICAL UPDATE: Use the Stored Procedure SP_AddNewShift
        // It takes shift_name, start_time, and end_time as parameters.
        $stmt = $conn->prepare("CALL SP_AddNewShift(?, ?, ?)");
        
        // Bind parameters (s=string)
        $stmt->bind_param("sss", $shiftName, $startTime, $endTime); 
        
        if ($stmt->execute()) {
            $message = "Shift '" . htmlspecialchars($shiftName) . "' successfully created using Stored Procedure.";
            header("Location: add_shifts.php?message=" . urlencode($message));
            exit();
        } else {
            // This will capture the exact MySQL error (e.g., duplicate shift name)
            $error = "Database insertion error: " . $conn->error; 
            header("Location: add_shifts.php?error=" . urlencode($error));
            exit();
        }
        $stmt->close();

    } catch (Exception $e) {
        error_log("Add Shift Error: " . $e->getMessage());
        $error = "An unexpected server error occurred.";
        header("Location: add_shifts.php?error=" . urlencode($error));
        exit();
    }
}
?>