<?php
// db_connect.php - FINAL CORRECTED VERSION
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";  
$username = "root";       
$password = "";          // Must be empty string
$dbname = "cafe_staff_management_db"; // CHECK THIS NAME against phpMyAdmin
$port = 3306;              // Correct port from your new setup

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("<h1>❌ Database Connection Failed!</h1>" .
        "<h2>MySQL Error:</h2>" .
        "<code>" . htmlspecialchars($conn->connect_error) . "</code>"
    );
}

// If connection succeeds, this line makes $conn available to files that require this script
return $conn;
?>