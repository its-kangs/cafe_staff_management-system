<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$conn = require 'db_connect.php'; 

$userId = $_SESSION['user_id'];
$userRoleId = $_SESSION['role_id'];

$error = $_GET['error'] ?? null;
$message = $_GET['message'] ?? null;


$isAdminPage = (basename($_SERVER['PHP_SELF']) === 'staff_list.php'); 


if ($isAdminPage && $userRoleId != 1) {
    header("Location: staff_dashboard.php?error=" . urlencode("Access denied."));
    exit();
}
?>