<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = ["email" => "ahmedabass4801@gmail.com", "password" => "eltramador123"];
}
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = ["A@A" => "123", "F@A" => "123"];
}
// if (!isset($_SESSION['user']) && isset($_COOKIE['remember_email'])) {
//     $rememberedEmail = $_COOKIE['remember_email'];

//     if (array_key_exists($rememberedEmail, $_SESSION['users'])) {
//         $_SESSION['user'] = $rememberedEmail;
//         header("Location: client.php");
//         exit();
//     }
// }
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = "";
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // if (isset($_POST['rem']) && $_POST['rem'] == "rememper"){
        // cookie code addition 
    // }
    if ($email === $_SESSION['admin']['email']){
        if($password === $_SESSION['admin']['password']){
            $_SESSION['current_admin'] = explode('@', $email)[0];
            header("Location: admin.php");
            exit();
        } else {
            $error = "wrong passowrd<br>you can recreate your password from link above";   
        }
    } elseif (array_key_exists($email, $_SESSION['users'])) {
        if ($_SESSION['users'][$email] === $password) {
            $_SESSION['user'] = explode('@', $email)[0];
            header("Location: client.php");
            exit();
        } else {
            $error = "wrong passowrd<br>you can recreate your password from link above";
        }
    } else {
        $error = "email not found<br>you can create new account from link above";
    }
}
include("login-page.php");
?>