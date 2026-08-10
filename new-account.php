<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = ["email" => "ahmedabass4801@gmail.com", "password" => "eltramador123"];
}
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $message = "";
    if (array_key_exists($_POST['email'], $_SESSION['users']) || $_POST['email'] == $_SESSION['admin']['email']){
        $message = "there is other user uses this email<br>try another email";
    } elseif($_POST['Confirm-password'] == $_POST['password']) {
        $_SESSION['users'][$_POST['email']] = $_POST['password'];
        header("Location: index.php");
        exit();
    } else {
        $message = "your passwords don't match<br>try again";
    }
}
include("new-account-page.php");
?>