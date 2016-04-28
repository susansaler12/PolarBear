<?php
//listfriendrequest.php
session_start();

require_once "../Model/DB_connection.php";

$db = DB_connection::getDB();

$_SESSION['id'] = 2; //user id I put in manually for testing

$user = $_SESSION['id'];

$listrequest = "SELECT * FROM user_profiles u INNER JOIN friendlist f ON u.id = f.id
WHERE f.idfriend = '$user' AND f.status IS NULL;";
$result = $db->query($listrequest);
$result->execute();

foreach($result as $r) {
    echo "<div>" . $r['fname'] . " " . $r['lname'] . "</div>";
}

?>