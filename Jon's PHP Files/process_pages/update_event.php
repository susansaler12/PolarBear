<?php
if(isset($_POST['finished_form'])){

    $event_descrip = $_POST['event_descrip'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $guest_of_honor =  $_POST['guest_of_honor'];

    //Validate for Event Date -- Currently validated in Javascript

    include('../Models/DB_connection.php');
    include('../Models/events_DB.php');
    $events = new events;
    $creator = "jonboss1@hotmail.com"; //This will be coming from the login session eventually

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
            header("Location:../Views/index.php?message=$message");
            exit;
        }

        $message = $events::updateEvent($event_id, $event_descrip, $event_date, $event_location, $guest_of_honor, $surprise_for);
        header("Location:../Views/index.php?message=$message");
        exit;
    }

    else{
        $message = $events::newEvent($event_descrip,$event_date,$event_location, $creator, $guest_of_honor, $surprise_for);
        header("Location:../Views/index.php?message=$message");
        exit;
    }
}
else{
    $message = "Please select a record, or click to Create a New Event";
    header("Location:../Views/index.php?message=$message");
}
