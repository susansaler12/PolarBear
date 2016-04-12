<?php
//need to make a friends list
//the user needs to be able to search for a friend using email
//then the friendee is added to the friendslist table
//the status is 0 meaning that the friend is not confirmed
//if the friend request is accepted then the status should be 1
//if friend request is confirmed then friender and friendee should be able to view each others prof

require_once "location:../Model/database.php";
session_start();
$_SESSION['id']=8;//this is the userid I manually put in so I don't get kicked out
$user["id"]=($_SESSION['id']);
//Read your session (if it is set)

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

if (isset ($_POST['afriend']) && $_POST['afriend'] == 'Add Friend') {
    $email = $_POST['email'];

    $idfriend = "SELECT id FROM user_profiles WHERE email = '$email'";//idfriend needs to be the id of the user
    //they are trying to friend from the user profiles page
    $result = $db->query($idfriend);
    $user = $result->fetch();
    if ($user == null){
        echo "<p>Sorry, that email is not registered with us</p>";
    }
    else{

    $id = $user["id"];
   $sql = "INSERT INTO friendlist (idfriend, status, active) VALUES ($id, 0, false)";
    //booleans DO NOT accept nulls, need to be true or false

 if($count = $db->exec($sql) == 1 ){
     echo "<p>Friend request sent</p>";
 }
    else {
        echo "<p>Error, unable to send friend request</p>";
    }

}
}
else{
    echo  "<p>Please enter an email</p>";
}

?>

