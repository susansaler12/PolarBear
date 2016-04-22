<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
include('../Model/DB_connection.php');
include('../Model/invites_DB.php');
include('../Model/events_DB.php');

//This code will allow users to select a friend
if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    $event = events::getEvent($event_id);
    $event_name = $event->event_name;
}
else{
    header("Location:calendar_view.php");
}
require_once "header.php";
?>
<h1><?php echo $event_name ?></h1>
<form action="../Controller/add_invite.php?event_id=<?php echo $event_id ?>" method="post" name="invite_form" id="invite_form">
    <label for="invitee" >Friend to Invite: </label>
    <input type="text" name="invitee" value=""/><br/>
    <label for="invite_priv">Invite Privileges</label>
    <input type="checkbox" name="invite_priv"/><br/>
<br/>
    <input type="submit" name="finished_form" value="Invite"/>
</form>
<?php require_once "footer.php" ?>
