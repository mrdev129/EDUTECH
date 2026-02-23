<?php
include '../config/db.php';

$id = $_GET['id'];

$conn->query("UPDATE contact_inquiries 
              SET status='read', viewed_at=NOW() 
              WHERE id='$id'");
?>