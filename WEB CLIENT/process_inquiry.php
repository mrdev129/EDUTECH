<?php
/**
 * EduTech Admission Experts - Inquiry Processing Script
 * Aligned with existing db_configure.php and edutech_db schema.
 */

// 1. INCLUDE YOUR EXISTING CONFIGURATION
require_once 'db_config.php';

// 2. PROCESS FORM SUBMISSION
if (isset($_POST['submit_inquiry'])) {
    
    /**
     * Sanitize user inputs using the $conn variable from db_configure.php
     * This prevents SQL Injection by escaping special characters.
     */
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $course   = mysqli_real_escape_string($conn, $_POST['course']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $budget   = mysqli_real_escape_string($conn, $_POST['budget']);
    $message  = mysqli_real_escape_string($conn, $_POST['message']);

    /**
     * 3. SQL INSERTION
     * Matches your schema: name, mobile, email, course, location, budget, message.
     * status defaults to 'New' and created_at to CURRENT_TIMESTAMP in DB.
     */
    $sql = "INSERT INTO inquiries (name, mobile, email, course, location, budget, message) 
            VALUES ('$name', '$mobile', '$email', '$course', '$location', '$budget', '$message')";

    

    if (mysqli_query($conn, $sql)) {
        /**
         * 4. SUCCESS REDIRECTION
         * Sends user back to the inquiry page with a success parameter.
         */
        header("Location: inquiry.php?status=success");
        exit();
    } else {
        /**
         * 5. ERROR HANDLING
         */
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // Redirect if the file is accessed without submitting the form
    header("Location: inquiry.php");
    exit();
}

// Close the connection
mysqli_close($conn);
?>