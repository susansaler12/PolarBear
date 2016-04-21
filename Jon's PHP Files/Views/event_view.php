<?php
if(isset($_GET['event_id'])){
    include('../Models/DB_connection.php');
    include('../Models/invites_DB.php');
    include('../Models/events_DB.php');
    $results = events::getEvent($_GET['event_id']);
}
else{
    header('Location:../Views/event_details.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="./styles/event_vieww.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script></script>
    <title>View Event</title>
</head>
<body>
<h1 id="event_details_name"><?php echo $results->event_name ?></h1>
<p id="event_details_date"><?php echo $results->event_date ?></p>
<p id="event_details_location"><?php echo $results->event_location ?></p>
<p id="event_details_descrip"><?php echo $results->event_descrip ?></p>
<p id="event_details_goh"><?php echo $results->guest_of_honor ?></p>
<?php if($results->surprise_for == 1){echo "<p>THIS IS A SURPRISE EVENT!</p>";}?>
<span><a href="event_invite.php">Invite Guests</a> | <a href="calendar_view.php">View Calendar</a></span><br/><br/>
<form action="../process_pages/add_invite.php?event_id=<?php echo $event_id ?>" method="post" name="invite_form" id="invite_form">
    <label for="invitee" >Friend to Invite: </label>
    <input type="text" name="invitee" value=""/><br/>
    <label for="invite_priv">Invite Privileges</label>
    <input type="checkbox" name="invite_priv"/><br/>
    <br/>
    <input type="submit" name="finished_form" value="Invite"/>
</form>
</body>
</html>
