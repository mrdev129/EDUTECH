<?php
$host = "localhost"; // Change to your InfinityFree host (e.g., sqlXXX.infinityfree.com) for live
$user = "root";      // Change to your if0_XXXX username for live
$password = "";      // Change to your Hosting Password for live
$database = "edutech"; // Change to if0_XXXX_edutech for live

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// 1. Keep your Admin Email
define('ADMIN_EMAIL', 'festronixcodemadone@gmail.com');

// 2. Add your Gmail App Password here
// Create this in Google Account > Security > App Passwords
define('SMTP_USER', 'codemadofficial@gmail.com'); 
define('SMTP_PASS', 'scob hgqk gzuf ukup'); 

mysqli_set_charset($conn, "utf8mb4");
?>