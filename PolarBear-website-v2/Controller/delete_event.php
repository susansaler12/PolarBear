<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
include('../Model/DB_connection.php');
include('../Model/events_DB.php');

$event_id = $_GET['event_id'];

$int_value = ctype_digit($event_id) ? intval($event_id) : null;
if ($int_value === null)
{
    $result = "Please select an Event, or click to create a new one";
}
else{
    $result = events::deleteEvent($_GET['event_id']);
}

header('Location:../Views/index1.php?message=' . $result);
exit;