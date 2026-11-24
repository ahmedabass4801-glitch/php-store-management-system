<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $config = require __DIR__ . '/config.php';
    $_SESSION['admin'] = ["email" => $config['admin_email'], "password" => $config['admin_password']];
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
include("views/new-account-page.php");
?>