<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
if(isset($_POST['finished_form'])){
    $event_name = $_POST['event_name'];
    $event_descrip = $_POST['event_descrip'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $guest_of_honor =  $_POST['guest_of_honor'];

    //Validate for Event Date -- Currently validated in Javascript
    include('../Model/DB_connection.php');
    include('../Model/events_DB.php');
    include('../Model/invites_DB.php');
    $creator = $_SESSION['id']; //This will be coming from the login session

    if($_POST['surprise_for'] == null or $_POST['surprise_for'] == "off"){
        $surprise_for = 0;
    }
    else{
        $surprise_for = 1;
    }

    if(isset($_GET['event_id'])){
        $event_id = $_GET['event_id'];
        $int_value = ctype_digit($event_id) ? intval($event_id) : null;
        if ($int_value === null)
        {
            $message = "Sorry, a validation error occurred.";
            header("Location:../View/calendar_view.php?message=$message");
            exit;
        }

        $message = events::updateEvent($event_id, $event_name, $event_descrip, $event_date, $event_location, $guest_of_honor, $surprise_for);
        header("Location:../View/calendar_view.php?message=$message");
        exit;
    }

    else{
        $message = events::newEvent($event_name, $event_descrip, $event_date, $event_location, $creator, $guest_of_honor, $surprise_for);
        $newID = events::getID();
        invites::invite_guests($newID[0],$creator,$creator,1);
        invites::confirm_invite($newID[0],$creator);
        header("Location:../View/calendar_view.php?message=$message");
        exit;
    }
}
else{
    $message = "Please select a record, or click to Create a New Event";
    header("Location:../View/calendar_view?message=$message");
}
