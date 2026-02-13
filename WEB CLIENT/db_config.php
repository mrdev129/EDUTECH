<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Default for local; change for live hosting [cite: 25]
$password = "";     // Default for local; change for live hosting [cite: 25]
$dbname = "edutech_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to utf8mb4 for special characters
mysqli_set_charset($conn, "utf8mb4");
?>