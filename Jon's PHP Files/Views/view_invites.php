<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create and Update Events</title>
    <link rel="stylesheet" type="text/css" href="../styles/eventStyle.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <h1>Pending Invites</h1>
<?php
include('../Models/DB_connection.php');
include('../Models/events_DB.php');
include('../Models/invites_DB.php');


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
$tOutput .= "</table>";
echo $tOutput;
?>
<h3><a href="event_details.php" id="create_button">Create a New Event</a></h3>
<?php
if(isset($_GET['message'])){
    echo "<h2>" . $_GET['message'] . "</h2>";
}
?>
</body>
</html>