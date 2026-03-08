<?php

session_start();

if(!isset($_SESSION['login_otp'])){
echo "expired";
exit;
}

$user_otp = $_POST['otp'];

if(time() > $_SESSION['otp_expiry']){
echo "expired";
exit;
}

if($user_otp == $_SESSION['login_otp']){

echo "success";

}else{

echo "invalid";

}