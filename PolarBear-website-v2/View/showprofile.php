<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
$id = $_SESSION['id'];
//this is my page for showing 1 profile of a specific user
require_once "../Model/DB_connection.php";


$sql ="SELECT * FROM user_profiles WHERE id = 9"; //you dont have to name is query you can name it anything
$db = DB_connection::getDB();
$result = $db->query($sql);


require_once "header.php";
require_once "../Model/GordFeatures.php";
foreach($result as $p){

    echo "<div class='Pname'>" . $p['fname'] . " " . $p['lname'] . "</div>";
    echo "<div class='Pinterests'>" . "Interests:" ." " . $p['interests'] . "</div>";
    echo "<div class='Pimage'>" . $p['image'] . "</div>";
        /*

        " : " . $p['location'] . " : " . $p['birthday'] .
        " : " . $p['interests'] . "</div>";
    $fupdate = "<form action ='updateprofileform.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='uprofile' value='UPDATE'/>".
        "</form>";
    echo $fupdate . "<div>";
    $fdelete = "<form action ='deleteprofile.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='dprofile' value='DELETE'/>".
        "</form>";
    echo $fdelete . "<div>";
        */

    $fupdate = "<form action ='updateprofileform.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='uprofile' value='UPDATE'/>".
        "</form>";
    echo $fupdate . "<div>";

    echo GordFeatures::printWishlist($id);
    //This will print the current user's id
    //If you need to do this for other people's profiles this will require other logic
    ?><span><a href="calendar_view.php">View Events</a><?php
}
require_once "footer.php";
?>