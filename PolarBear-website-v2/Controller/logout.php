<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['fname']);
$_SESSION['loggedIn'] = false;

$_SESSION = array();
session_destroy();

header("location:../View/index1.php");
?>