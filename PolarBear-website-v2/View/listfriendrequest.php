<?php
//listfriendrequest.php
session_start();

require_once "../Model/DB_connection.php";

$db = DB_connection::getDB();

$_SESSION['id'] = 1; //userid I manually put in for testing- delete this before submission

$user = $_SESSION['id'];

//get the id of the person who sent the friend request
$friender = "SELECT u.id FROM user_profiles u INNER JOIN friendlist f ON u.id = f.id
WHERE f.idfriend = '$user' AND f.status IS NULL;";
$prepared = $db->prepare($friender);
$prepared->execute();
$frienderid = $prepared->fetch();

//var_dump($frienderid);

//get all of the information of the person who sent the friend request
$listrequest = "SELECT * FROM user_profiles u INNER JOIN friendlist f ON u.id = f.id
WHERE f.idfriend = '$user' AND f.status IS NULL;";
$result = $db->query($listrequest);
$result->execute();

//forms with buttons for confrim or deny friend
foreach($result as $r) {
    echo "<div>" . $r['fname'] . " " . $r['lname'] . "</div>";

    echo "<form method='post'> <input type='submit' value='Confrim Friend' name='confirmfriend'/> </form>";

    echo "<form method='post'> <input type='submit' value='Deny Friend' name='denyfriend'/> </form>";
}
//if the user clicks the confirm friend button then the status should be set to 1
if (isset ($_GET['confirmfriend']) && $_GET['confirmfriend'] == 'Confirm Friend') {
    echo "test confirm";
    $confirmed = "UPDATE friendlist
    SET status = 1
    WHERE id = '$frienderid' AND idfriend = '$user'";
    $cresult = $db->query($confirmed);
    $cresult->execute();
    echo "friend request has been accepted";
}
//if the user denies friend then set the status to 0
if (isset ($_GET['denyfriend']) && $_GET['denyfriend'] == 'Deny Friend') {
echo "test deny";
    $denied = "UPDATE friendlist
    SET status = 0
    WHERE id = '$frienderid' AND idfriend = '$user'";
    $dresult = $db->query($denied);
    $dresult->execute();
    echo "friend request has been denied";
}

//on submit make make an isset so that friendlist will be updated where the id of the user and friender are


?>


