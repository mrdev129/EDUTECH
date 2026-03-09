<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

session_start();
include '../config/db.php';

$otp = rand(100000,999999);

$_SESSION['login_otp'] = $otp;
$_SESSION['otp_expiry'] = time() + 60; // 1 minutes
$_SESSION['otp_resend_time'] = time() + 60;
$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($conn,"SELECT * FROM admin_credentials
WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($query)==1){

    $admin = mysqli_fetch_assoc($query);

    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_email'] = $admin['email'];

    $otp = rand(100000,999999);
    $_SESSION['login_otp'] = $otp;

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
    $mail->Port = $_ENV['SMTP_PORT'];

    $mail->setFrom($_ENV['SMTP_USER'],'EDUTECH Admin');
    $mail->addAddress($admin['email']);

    $mail->Subject = 'Admin Login OTP';
    $mail->Body = "Your OTP is: ".$otp;

    $mail->send();

    header("Location: otp-verification.php");

}else{

    echo "<script>alert('Invalid username or password');window.location='index.php';</script>";

}