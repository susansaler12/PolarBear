<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel='stylesheet' href='../dependencies/fullcalendar-2.6.1/fullcalendar.min.css' />
    <link rel='stylesheet' href='../dependencies/jquery-ui-1.11.4.custom/jquery-ui.min.css' />
    <link rel='stylesheet' href='../dependencies/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css' />
    <link rel="stylesheet" href="../dependencies/bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
    <link rel='stylesheet' href='../styles/calendar_style.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src='../dependencies/fullcalendar-2.6.1/lib/moment.min.js'></script>
    <script src='../dependencies/fullcalendar-2.6.1/fullcalendar.min.js'></script>
    <script src='../dependencies/bootstrap-3.3.6-dist/js/bootstrap.min.js'></script>
    <script src='../scripts/calendar_build.js'></script>
    <title>View Events</title>
</head>
<body>
    <div id="calendar" class="ui-widget" style=""></div>
    <div id="dark_background">
        <div id="event_details_display">
            <h2 id="event_details_title"></h2>
            <h3 id="event_details_date"></h3>
            <p id="event_details_location"></p>
            <p id="event_details_goh"></p>
            <p id="surprise_party"></p>
        </div>
    </div>
</body>
</html>
<?php
include('../Models/DB_connection.php');
include('../Models/invites_DB.php');
include('../Models/events_DB.php');

$loggedIn = 'GordSchnurr@gmail.com';
$events = events::getEventsForUser($loggedIn);
$arraytoJSON = [];

$eventsJSON = json_encode($events);
echo "<script>buildCalendar($eventsJSON)</script>";

?>

