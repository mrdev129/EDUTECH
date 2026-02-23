<?php
$host = "localhost"; // Change to your InfinityFree host (e.g., sqlXXX.infinityfree.com) for live
$user = "root";      // Change to your if0_XXXX username for live
$password = "";      // Change to your Hosting Password for live
$database = "edutech"; // Change to if0_XXXX_edutech for live

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>