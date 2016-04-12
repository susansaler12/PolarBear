<?php
include('../Models/DB_connection.php');
include('../Models/events_DB.php');
$events = new events;

$event_id = $_GET['event_id'];

$int_value = ctype_digit($event_id) ? intval($event_id) : null;
if ($int_value === null)
{
    $result = "Please select an Event, or click to create a new one";
}
else{
    $result = $events::deleteEvent($_GET['event_id']);
}

header('Location:../Views/index.php?message=' . $result);
exit;