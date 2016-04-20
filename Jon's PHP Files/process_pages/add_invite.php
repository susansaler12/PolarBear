<?php
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

    include('../Models/DB_connection.php');
    include('../Models/invites_DB.php');

    $result = invites::invite_guests($event_id, $inviter, $invitee, $invite_priv);
    header('Location:../Views/index.php?message=' . $result);
}