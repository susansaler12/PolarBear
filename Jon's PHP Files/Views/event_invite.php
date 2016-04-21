<link rel="stylesheet" type="text/css" href="../styles/eventStyle.css"/>
<?php

include('../Models/DB_connection.php');
include('../Models/invites_DB.php');
include('../Models/events_DB.php');

//This code will allow users to select a friend
if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    $event = events::getEvent($event_id);
    $event_name = $event->event_name;
}
?>
<h1><?php echo $event_name ?></h1>
<form action="../process_pages/add_invite.php?event_id=<?php echo $event_id ?>" method="post" name="invite_form" id="invite_form">
    <label for="invitee" >Friend to Invite: </label>
    <input type="text" name="invitee" value=""/><br/>
    <label for="invite_priv">Invite Privileges</label>
    <input type="checkbox" name="invite_priv"/><br/>
<br/>
    <input type="submit" name="finished_form" value="Invite"/>
</form>
