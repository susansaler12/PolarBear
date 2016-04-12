<?php

require_once "../Model/database.php";
$_SESSION['id']=8;//this is the userid I manually put in so I don't get kicked out
$user["id"]=($_SESSION['id']);
//$user["id"]=($_SESSION['id']);
//Read your session (if it is set)
//this part is to make sure users are logged in
if(isset($_SESSION['id']))
{
    echo "<a href='logout.php'>Logout</a>";
    //DO WHATEVER YOU WANT, LIKE REDIRECT TO PAGE
    //header("location:../message-board/index.php");
}

else{
    echo "Please login to add friends";
    header("location:../Becky-features/login/login.php");//important to include location
}
//need to check if the user that wants to view the guest list, if their id is listed in the guest list table
$sql="SELECT id FROM friendlist WHERE id='$user'";
$db->exec($sql);
if ($db=null){
    echo "You need to be invited in order to view this event";
}
else{
    header("location:../profile/View/eventviewtest.php");
}


?>