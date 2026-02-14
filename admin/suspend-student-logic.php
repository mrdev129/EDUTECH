<?php
include('../config/db.php');

// ✅ Ensure an ID is passed to manage the correct student
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ✅ Change status to 'Suspended' 
    // This moves the data from the 'Active' sector to the 'Suspended' sector in the DB
    $sql = "UPDATE students SET status = 'Suspended' WHERE id = '$id'";
    
    if ($conn->query($sql)) {
        // ✅ Success: Redirect to the suspended list to show the result
        // The student is now hidden from student-list.php
        header("Location: suspended-student.php?msg=suspended");
        exit();
    } else {
        // Handle database errors if the update fails
        die("Error updating record: " . $conn->error);
    }
} else {
    // If no ID is found, return to the main list safely
    header("Location: student-list.php");
    exit();
}
?>