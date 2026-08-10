<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = ["email" => "ahmedabass4801@gmail.com", "password" => "eltramador123"];
}
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $message_1 = ""; $message_2 = ""; $found = false;
    if (!isset($_POST['new-password']) && !isset($_POST['confirm-new-password'])){
        if (!array_key_exists($_POST['email'], $_SESSION['users']) && ($_POST['email'] !== $_SESSION['admin']['email'])) {
            $message_1 = "account not found<br>Try Again";
            } elseif(array_key_exists($_POST['email'], $_SESSION['users'])) {
                $_SESSION['em'] = $_POST['email'];
                $_SESSION['pass'] = $_SESSION['users'][$_POST['email']];
                $found = true;
                } elseif ($_POST['email'] === $_SESSION['admin']['email']) {
                    $_SESSION['em'] = $_POST['email'];
                    $_SESSION['pass'] = $_SESSION['admin']['password'];
                    $found = true;
                }
    }
    if (isset($_POST['new-password']) && isset($_POST['confirm-new-password'])) {
        $found = true;
        if ($_POST['new-password'] !== $_POST['confirm-new-password']){
            $message_2 = "your password don't match<br> Try Again";
        } elseif ($_POST['new-password'] === $_SESSION['pass']) {
            $message_2 = "you can't use your old password<br> Try Again";
        } else {
            if ($_SESSION['em'] === $_SESSION['admin']['email']){
                $_SESSION['admin']['password'] = $_POST['new-password'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['users'][$_SESSION['em']] = $_POST['new-password'];
                header("Location: index.php");
                exit();
            }
        }
    }
}
include("forget-password-page.php");
?>
