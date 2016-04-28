<?php
//Make a copy before you change anything
session_start();

require_once "../Model/DB_connection.php";
$db = DB_connection::getDB();

$user = $_SESSION['id'];

if (isset ($_POST['confirmfriend']) && $_POST['confirmfriend'] == 'Accept Friend Request') {

    $friender = "SELECT id FROM friendlist WHERE idfriend = '$user' AND status = NULL;";
    $stm = $db->prepare($friender);
    $stm->execute();
    $rows = $stm->fetchAll();

    $confirmed = "UPDATE friendlist
    SET status = 1
    WHERE id = '$friender' AND idfriend = '$user';";
    $statment = $db->prepare($confirmed);
    $statment->execute();
    $rows = $statment->fetchAll();
}
else{
    echo"a problem has occured, please try again";
}

?>