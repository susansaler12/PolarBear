<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];

if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

include('../Model/DB_connection.php');
include('../Model/events_DB.php');
include('../Model/invites_DB.php');
require_once "header.php";

$tOutput = "<table id='main-display'><thead><th>Event Name</th><th>Description</th><th>Date</th><th>Location</th>><th>Guest of Honor</th></thead>";
$allEvents = events::getEventsForUser(1);

foreach($allEvents as $row){
    $tOutput .= "<tr>";
    $tOutput .= "<td>" .$row['event_name']."</td>";
    $tOutput .= "<td>" .$row['event_descrip']."</td>";
    $tOutput .= "<td>" .$row['event_date']."</td>";
    $tOutput .= "<td>" .$row['event_location']."</td>";
    $tOutput .= "<td><a href='event_details.php?event_id=$row[0]'>EDIT</a> | <a id='delete_row' href='../process_pages/delete_event.php?event_id=$row[0]'>DELETE</a> | <a href='event_invite.php?event_id=$row[0]'>INVITE</a></td></tr>";
}
$tOutput .= "</table>"; ?>

<h1>Pending Invites</h1>

<?php echo $tOutput;
if(isset($_GET['message'])){
    echo "<h2>" . $_GET['message'] . "</h2>";
}
require_once "footer.php"?>
