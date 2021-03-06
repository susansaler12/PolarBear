<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:../View/login.php");
    exit();
}
if(isset($_POST['finished_form'])){
    $invitee = $_POST['invitee'];
    $event_id = $_GET['event_id'];
    if(isset($_POST['invite_priv']) && $_POST['invite_priv'] == "on"){
        $invite_priv = 1;
    }
    else{
        $invite_priv = 0;
    }

    //This will have to depend on the person logged in!
    $inviter = 1;

    include('../Model/DB_connection.php');
    include('../Model/invites_DB.php');
    if(invites::check_exists($invitee,$event_id) != 0){
        header("Location:../View/event_view.php?event_id=" . $event_id . "&message=User is already invited!");
    }
    $result = invites::invite_guests($event_id, $inviter, $invitee, $invite_priv);
    header("Location:../View/event_view.php?event_id=" . $event_id . "&message=Thank you, Invite Sent!");
}