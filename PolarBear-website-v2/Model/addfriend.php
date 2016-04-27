<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
//need to make a friends list
//the user needs to be able to search for a friend using email
//then the friendee is added to the friendslist table
//the status is 0 meaning that the friend is not confirmed
//if the friend request is accepted then the status should be 1
//if friend request is confirmed then friender and friendee should be able to view each others prof

require_once "../Model/DB_connection.php";

$db = DB_connection::getDB();

    //$_SESSION['id'] = 3; //this is the userid I manually put in so I don't get kicked out
    $userid=($_SESSION['id']);

if(isset ($_POST['addFriendSubmit']) && $_POST['addFriendSubmit'] == 'Invite') {

    $idfriend = $_POST['id'];

    $sql = "INSERT INTO friendlist (id, idfriend, status) VALUES (:id, :idfriend,:status)";
    //booleans DO NOT accept nulls, need to be true or false, unless you change the database setup
    //our database is set up to automatically put status to null
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->bindValue(':id', $userid, PDO::PARAM_INT);
    $stm->bindValue(':idfriend', $user['id'], PDO::PARAM_INT);
    $stm->bindValue(':status', NULL);
    $stm->execute();

    header('Location:../View/showprofile.php');
}

?>

