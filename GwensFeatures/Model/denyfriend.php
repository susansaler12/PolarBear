<?php
//Make a copy before you change anything
session_start();

require_once "../Model/database.php";
$db = DB_connection::getDB();

$_SESSION['id'] = 3; //this is the userid I manually put in so I don't get kicked out
$user = $_SESSION['id'];

//this is the action on the accept friend button click, if button clicked then status is set to 1 in friendlist
//this means that now the two users are friends
if (isset ($_POST['denyfriend']) && $_POST['denyfriend'] == 'Deny Friend Request') {
    $sql = "UPDATE friendlist
    SET status = 0
    WHERE id = $user";
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->execute();
    //$message = "Inserted " . $row;
    echo "Friend request denied";
}
else{
    echo"A problem has occured, please try again";
}

?>