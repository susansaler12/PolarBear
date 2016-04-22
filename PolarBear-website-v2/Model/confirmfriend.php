<?php
//Make a copy before you change anything
session_start();

require_once "../Model/DB_connection.php";
$db = DB_connection::getDB();

$user = $_SESSION['id'];

//this is the action on the accept friend button click, if button clicked then status is set to 1 in friendlist
//this means that now the two users are friends
if (isset ($_POST['confirmfriend']) && $_POST['confirmfriend'] == 'Accept Friend Request') {
    $sql = "UPDATE friendlist
    SET status = 1
    WHERE id = $user";
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->execute();
    //$message = "Inserted " . $row;
    echo "Friend request accepted";
}
else{
    echo"a problem has occured, please try again";
}

?>