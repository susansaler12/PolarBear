<?php
//Make a copy before you change anything
session_start();

require_once "../Model/DB_connection.php";
$db = DB_connection::getDB();

$user = $_SESSION['id'];

//this is the action on the accept friend button click, if button clicked then status is set to 1 in friendlist
//this means that now the two users are friends
if (isset ($_POST['denyfriend']) && $_POST['denyfriend'] == 'Deny Friend Request') {
    $friender = "SELECT id FROM friendlist WHERE idfriend = '$user' AND status = NULL;";
    $stm = $db->prepare($friender);
    $stm->execute();
    $rows = $stm->fetchAll();

    $denied = "UPDATE friendlist
    SET status = 0
    WHERE id = '$friender' AND idfriend = '$user';";
    $statment = $db->prepare($denied);
    $statment->execute();
    $rows = $statment->fetchAll();
}
else{
    echo"A problem has occured, please try again";
}
?>