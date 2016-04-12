<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['id']);
unset($_SESSION['fname']);
unset($_SESSION['email']);
unset($_SESSION['password']);
$_SESSION['loggedIn'] = false;

$_SESSION = array();
session_destroy();

header("location:login.php");
?>