<?php

require 'auth_guard.php'; 

$staffId = $_GET['id'] ?? null;


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$staffId) {
    header("Location: staff_list.php?error=" . urlencode("Invalid request."));
    exit();
}

$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$phone = $_POST['phone'] ?? '';
$roleId = $_POST['role_id'] ?? null;


if (empty($firstName) || empty($lastName) || empty($roleId)) {
    $error = "First Name, Last Name, and Role are required fields.";
    header("Location: edit_shifts.php?id=" . $staffId . "&error=" . urlencode($error));
    exit();
}

try {
    
    $stmt = $conn->prepare("UPDATE staff SET first_name = ?, last_name = ?, phone = ?, role_id = ? WHERE staff_id = ?");
    $stmt->bind_param("ssisi", $firstName, $lastName, $phone, $roleId, $staffId);
    
    if ($stmt->execute()) {
        $message = "Staff details updated successfully.";
        header("Location: staff_list.php?message=" . urlencode($message));
        exit();
    } else {
        $error = "Database update failed: " . $conn->error;
        header("Location: edit_shifts.php?id=" . $staffId . "&error=" . urlencode($error));
        exit();
    }
    $stmt->close();

} catch (Exception $e) {
    error_log("Edit Staff Error: " . $e->getMessage());
    $error = "An unexpected server error occurred.";
    header("Location: edit_shifts.php?id=" . $staffId . "&error=" . urlencode($error));
    exit();
}
?>