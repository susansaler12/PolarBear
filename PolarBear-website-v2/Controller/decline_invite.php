<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
$id = $_SESSION['id'];
if($loggedIn !== true){
    header("Location:../View/login.php");
    exit();
}

if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
}
else{
    header("Location:../View/calendar_view.php");
    exit();
}

include('../Model/DB_connection.php');
include('../Model/invites_DB.php');
include('../Model/events_DB.php');

$message = invites::clear_invite($event_id,$id);
header("Location:../View/calendar_view.php?message=$message");