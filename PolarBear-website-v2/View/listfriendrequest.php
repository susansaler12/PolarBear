<?php
//listfriendrequest.php

 //session information is required in order to get the user session id for the sql queries
// if you take this out EVERYTHING will break
//this is a separate view from the profile page and not a partial view

require_once "../Controller/session_start.php";

$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
require_once "header.php";
require_once "../Model/DB_connection.php";
$db = DB_connection::getDB();



$user = $_SESSION['id'];

//get the id of the person who sent the friend request
$friender = "SELECT u.id FROM user_profiles u INNER JOIN friendlist f ON u.id = f.id
WHERE f.idfriend = '$user' AND f.status IS NULL;";
$prepared = $db->prepare($friender);
$prepared->execute();
$frienderid['id'] = $prepared->fetch();
if (($prepared->fetch()) != null) {
foreach($frienderid['id'] as $key=>$frienderkey) { $$key = $frienderkey; }

//var_dump($frienderkey);

//get all of the information of the person who sent the friend request
$listrequest = "SELECT * FROM user_profiles u INNER JOIN friendlist f ON u.id = f.id
WHERE f.idfriend = '$user' AND f.status IS NULL;";
$result = $db->query($listrequest);
$result->execute();

//forms with buttons for confrim or deny friend
    echo "<div class='container'><div class='row'><h1>Friend Requests</h1>";

foreach($result as $r) {
    echo "<div style='display:inline-block;margin:20px;'><h4>" . $r['fname'] . " " . $r['lname'] . "</h4>";
    echo "<form method='post'> <input type='submit' value='Confirm Friend' name='confirmfriend' class=\"btn btn-info btn-block\"/> </form>";
    echo "<form method='post'> <input type='submit' value='Deny Friend' name='denyfriend' class=\"btn btn-info btn-block\" style='margin-top:5px;'/> </form></div>";
}

    echo "</div></div>";
//if the user clicks the confirm friend button then the status should be set to 1
if (isset ($_POST['confirmfriend']) && $_POST['confirmfriend'] == 'Confirm Friend') {
    $confirmed = "UPDATE friendlist
    SET status = 1
    WHERE id = '$frienderkey' AND idfriend = '$user'";
    $cresult = $db->query($confirmed);
    $cresult->execute();
    echo "friend request has been accepted";
}
//if the user denies friend then set the status to 0
if (isset ($_POST['denyfriend']) && $_POST['denyfriend'] == 'Deny Friend') {
    $denied = "UPDATE friendlist
    SET status = 0
    WHERE id = '$frienderkey' AND idfriend = '$user'";
    $dresult = $db->query($denied);
    $dresult->execute();
    echo "friend request has been denied";
}
}
else{
    echo "You don't have any friend requests pending.";
}
//on submit make make an isset so that friendlist will be updated where the id of the user and friender are

require_once "footer.php";
?>


