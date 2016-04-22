<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    include('../Model/DB_connection.php');
    include('../Model/invites_DB.php');
    include('../Model/events_DB.php');
    $results = events::getEvent($_GET['event_id']);
}
else{
    header('Location:event_details.php');
    exit();
}
require_once "header.php";
?>
<h1 id="event_details_name"><?php echo $results->event_name ?></h1>
<p id="event_details_date"><?php echo $results->event_date ?></p>
<p id="event_details_location"><?php echo $results->event_location ?></p>
<p id="event_details_descrip"><?php echo $results->event_descrip ?></p>
<p id="event_details_goh"><?php echo $results->guest_of_honor ?></p>
<?php if($results->surprise_for == 1){echo "<p>THIS IS A SURPRISE EVENT!</p>";}?>
<span><a href="event_invite.php">Invite Guests</a> | <a href="calendar_view.php">View Calendar</a></span><br/><br/>
<form action="../Controller/add_invite.php?event_id=<?php echo $event_id ?>" method="post" name="invite_form" id="invite_form">
    <label for="invitee" >Friend to Invite: </label>
    <input type="text" name="invitee" value=""/><br/>
    <label for="invite_priv">Invite Privileges</label>
    <input type="checkbox" name="invite_priv"/><br/>
    <br/>
    <input type="submit" name="finished_form" value="Invite"/>
</form>
<?php require_once "footer.php"; ?>
