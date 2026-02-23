<?php
// Include your existing database connection
require_once 'config/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Honeypot Check: If 'website' is filled, it's likely a bot
    if (!empty($_POST['website'])) {
        die("Spam detected.");
    }

    // 2. Sanitize and Collect Input
    $full_name = mysqli_real_escape_string($conn, $_POST['name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $city      = mysqli_real_escape_string($conn, $_POST['city']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $message   = mysqli_real_escape_string($conn, $_POST['message']);

    // 3. Basic Validation
    if (empty($full_name) || empty($email)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // 4. Prepare the SQL Statement
    $sql = "INSERT INTO contact_inquiries (full_name, email, city, phone, message) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $full_name, $email, $city, $phone, $message);

        if (mysqli_stmt_execute($stmt)) {
            echo "Thank you! Your inquiry has been submitted successfully.";
        } else {
            echo "Error: Could not execute the query.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare the query.";
    }

    mysqli_close($conn);
} else {
    echo "Invalid Request.";
}
?>