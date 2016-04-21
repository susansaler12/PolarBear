<?php
session_start();
require_once "../Model/database.php";
$db = DB_connection::getDB();

$_SESSION['id']=3;//this is the userid I manually put in so I don't get kicked out
$userid=($_SESSION['id']);


//this part is to make sure users are logged in
if(isset($_SESSION['id']))
{
    echo "<a href='logout.php'>Logout</a>";
    //DO WHATEVER YOU WANT, LIKE REDIRECT TO PAGE
    //header("location:../message-board/index.php");
}

else{
    echo "Please login to view guest list";
    header("location:../Becky-features/login/login.php");//important to include location
}
//need to check if the user that wants to view the guest list, if their id is listed in the guest list table
$sql="SELECT id FROM friendlist WHERE id='$userid'";
$db->exec($sql);
if ($db=null){
    echo "You need to be invited in order to view this event";
}
else{
    header("location:../profile/View/eventviewtest.php");
}


?>