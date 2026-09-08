<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "career_db";

// Connect to MySQL Database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check Connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set charset to utf8mb4 (To support special characters)
mysqli_set_charset($conn, "utf8mb4");
?>