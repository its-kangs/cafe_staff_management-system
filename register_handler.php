<?php

session_start();
$conn = require 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    
    $default_role_id = 2;
    $hire_date = date('Y-m-d');
    
    

    try {
        
        $stmt = $conn->prepare("INSERT INTO staff (first_name, last_name, phone, hire_date, role_id, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssiss", 
            $firstName, 
            $lastName, 
            $phone, 
            $hire_date, 
            $default_role_id, 
            $username, 
            $password 
        );
        
       
        
        if ($stmt->execute()) {
            
            
            $_SESSION['user_id'] = $conn->insert_id; 
            $_SESSION['role_id'] = $default_role_id;
            
            header("Location: staff_dashboard.php");
            exit();
        } else {
            if ($conn->errno == 1062) {
                $error = "Registration failed: Username already taken or Staff ID conflict.";
            } else {
                $error = "Registration failed: Database error: " . $conn->error;
            }
            header("Location: registration.php?error=" . urlencode($error));
            exit();
        }
        
        $stmt->close();
        
    } catch (Exception $e) {
        error_log("Registration Error: " . $e->getMessage());
        header("Location: registration.php?error=" . urlencode("An unexpected server error occurred."));
        exit();
    }
} else {
    header("Location: registration.php");
    exit();
}
?>