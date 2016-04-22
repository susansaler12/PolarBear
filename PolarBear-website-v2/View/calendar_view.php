<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
require_once "header.php";
?>
    <div id="calendar" class="ui-widget container" style=""></div>
    <div id="dark_background">
        <div id="event_details_display">
            <h2 id="event_details_name"></h2>
            <p id="event_details_date"></p>
            <p id="event_details_location"></p>
            <p id="event_details_descrip"></p>
            <p id="event_details_goh"></p>
            <p id="surprise_party"></p>
            <span><a href="#" id="view_link">View Event</a></span>
        </div>
    </div>
<?php
include('../Model/DB_connection.php');
include('../Model/invites_DB.php');
include('../Model/events_DB.php');

//$loggedIn = $_SESSION['id'];
$loggedIn = 1;
$events = events::getEventsForUser($loggedIn);
$eventsJSON = json_encode($events);
echo "<script>buildCalendar($eventsJSON)</script>";
require_once "footer.php";
?>