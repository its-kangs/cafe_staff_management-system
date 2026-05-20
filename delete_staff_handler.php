<?php

require 'auth_guard.php'; 

$staffId = $_GET['id'] ?? null;


if (!$staffId) {
    header("Location: staff_list.php?error=" . urlencode("Staff ID not specified for termination."));
    exit();
}

try {
   
    $stmt = $conn->prepare("CALL SP_TerminateStaff(?)");
    $stmt->bind_param("i", $staffId);
    
    if ($stmt->execute()) {
        $message = "Staff member successfully terminated (set to inactive) using Stored Procedure.";
        header("Location: staff_list.php?message=" . urlencode($message));
        exit();
    } else {
        $error = "Termination failed: " . $conn->error;
        header("Location: staff_list.php?error=" . urlencode($error));
        exit();
    }
    $stmt->close();

} catch (Exception $e) {
    error_log("Termination Error: " . $e->getMessage());
    $error = "An unexpected server error occurred during termination.";
    header("Location: staff_list.php?error=" . urlencode($error));
    exit();
}
?>