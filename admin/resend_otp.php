<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if(time() < $_SESSION['otp_resend_time']){
    echo "Please wait before requesting another OTP";
    exit;
}

$new_otp = rand(100000,999999);

$_SESSION['login_otp'] = $new_otp;
$_SESSION['otp_expiry'] = time() + 180;
$_SESSION['otp_resend_time'] = time() + 180;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $_ENV['SMTP_HOST'];
$mail->SMTPAuth = true;
$mail->Username = $_ENV['SMTP_USER'];
$mail->Password = $_ENV['SMTP_PASS'];
$mail->SMTPSecure = $_ENV['SMTP_SECURE'];
$mail->Port = $_ENV['SMTP_PORT'];

$mail->setFrom($_ENV['SMTP_USER'], 'EDUTECH Admin');

$mail->addAddress($_SESSION['admin_email']);

$mail->Subject = "Resend OTP";

$mail->Body = "Your new OTP is: ".$new_otp;

$mail->send();

echo "New OTP sent to your email";