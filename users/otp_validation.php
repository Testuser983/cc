<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    
    if ($action === 'sendOTP') {
        $useremail = $_POST['useremail'];
        $otp = rand(1000, 9999);
        $_SESSION['OTP']=$otp;
        echo "otp sent sucessfuly. your otp is :$otp";
        echo "user email is :$useremail";
       
    } elseif ($action === 'verifyOTP') {
        $userotp=$_POST['otp'];
        $storesotp=$_SESSION['OTP'];
        if ($userotp == $storesotp) {
            echo "OTP verified successfully";
           
        } else {
            echo "enteres otp: $userotp, stored otp: $storesotp Invalid otp";
           
        }
    } else {
        echo "invalid action";
    }
} else {
    echo "invaild request method";
}
?>