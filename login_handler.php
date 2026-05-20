
<?php

session_start();
$conn = require 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $error = '';

    if (empty($username) || empty($password)) {
        $error = "Both username and password are required.";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }

   
    $stmt = $conn->prepare("SELECT staff_id, password, role_id FROM staff WHERE username = ? AND is_active = 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['password'];
        
       
        if ($password === $storedPassword) { 
   
    $_SESSION['user_id'] = $user['staff_id'];
    $_SESSION['role_id'] = $user['role_id'];

            
            if ($user['role_id'] == 1) { 
                header("Location: staff_list.php"); 
            } else {
                header("Location: staff_dashboard.php");
            }
            exit();
        } else {
            
            $error = "Invalid username or password.";
        }
    } else {
       
        $error = "Invalid username or password.";
    }

    
    header("Location: login.php?error=" . urlencode($error));
    exit();
}
?>