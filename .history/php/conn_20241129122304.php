<?php

$db_user = "root";          
$db_pass = "";               
$db_name = "catering_db";    
$db_host = "localhost";     

try {
    
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $db = new PDO($dsn, $db_user, $db_pass);

    // Set PDO error mode to exception for easier debugging
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log error and show generic error message
    error_log("Database connection error: " . $e->getMessage()); // Log the error for debugging
    die('Database connection failed. Please try again later.');   // Generic error message
}