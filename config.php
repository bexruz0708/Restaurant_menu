<?php
// Database configuration
$host = "localhost";      // MySQL server
$user = "root";           // MySQL user (XAMPP default)
$password = "";           // MySQL password (XAMPP default bo‘sh)
$database = "restaurant_db"; // Siz yaratgan database nomi

// Connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
