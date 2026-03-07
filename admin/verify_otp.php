<?php
session_start();

$user_otp = $_POST['otp'];

if($user_otp == $_SESSION['login_otp']){

$_SESSION['admin_logged_in'] = true;

header("Location: index.php");

}else{

echo "<script>alert('Invalid OTP');window.location='otp-verification.php';</script>";

}
?>