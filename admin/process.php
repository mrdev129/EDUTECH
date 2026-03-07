<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$SMTP_HOST = $_ENV['SMTP_HOST'];
$SMTP_USER = $_ENV['SMTP_USER'];
$SMTP_PASS = $_ENV['SMTP_PASS'];
$SMTP_PORT = $_ENV['SMTP_PORT'];

session_start();
include '../config/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';


$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($conn,"SELECT * FROM admin_credentials
WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($query)==1){

    $admin = mysqli_fetch_assoc($query);

    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_email'] = $admin['email'];

    // GENERATE OTP
    $otp = rand(100000,999999);
    $_SESSION['login_otp'] = $otp;

    // SEND EMAIL
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth = true;
    // $mail->Username = 'debabratabehera437@gmail.com';
    // $mail->Password = 'hdttdhprcodrfdji';
    // $mail->SMTPSecure = 'tls';
    // $mail->Port = 587;

    $mail->setFrom('debabratabehera437@gmail.com','EDUTECH Admin');

    $mail->addAddress($admin['email']);

    $mail->Subject = 'Admin Login OTP';

    $mail->Body = "Your OTP is: ".$otp;

    $mail->send();

    header("Location: otp-verification.php");

}else{

    echo "<script>alert('Invalid username or password');window.location='login.php';</script>";

}

?>