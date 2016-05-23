<?php
require_once "../Controller/session_start.php";

$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

$id = $_SESSION['id'];
$friendid = $_GET['friendid'];
//this is my page for showing 1 profile of a specific user
require_once "../Model/DB_connection.php";


$sql ="SELECT * FROM user_profiles WHERE id = '$friendid'"; //you dont have to name is query you can name it anything
$db = DB_connection::getDB();
$result = $db->query($sql);


require_once "header.php";
require_once "../Model/GordFeatures.php";
foreach($result as $p){

    echo "<main id='showprofile' class='container friendProfile'>";
    echo "    <div class='row'>";
    echo "        <div class='col-sm-4 col-sm-offset-1 text-center'>";
    echo "            <div class='friendProfileImg Pimage'><img src='" . GordFeatures::profileImagePath($p['image']) . "'/></div>";
    echo "            <h1 class='Pname'>" . $p['fname'] . " " . $p['lname'] . "</h1>";
    echo "            <div class='Pinterests'>" . "Interests:" ." " . $p['interests'] . "</div>";
    echo "        </div>";
    echo "        <div class='col-sm-6'>";
    echo GordFeatures::printWishlist($friendid);
    //This will print the current user's id
    //If you need to do this for other people's profiles this will require other logic
    echo "        </div>";
    echo "    </div>";
    echo "</main>";

}
/* This is show friend profile, shouldn't show friend request
 * include "listfriendrequest.php"; */
require_once "footer.php";
?>