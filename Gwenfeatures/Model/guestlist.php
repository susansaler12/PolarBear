<?php

require_once "../Model/database.php";
$_SESSION['id']=8;//this is the userid I manually put in so I don't get kicked out

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


if (isset ($_POST['aguest']) && $_POST['aguest'] == 'Add Guest') {
    $email = $_POST['email'];

    $idfriend = "SELECT idfriend FROM friendlist INNER JOIN user_profiles ON friendlist.id = user_profiles.id WHERE user.profiles.email = '$email'";
    $result = $db->query($idfriend);
    $user = $result->fetch();
    if ($user == null){
        echo "<p>Sorry, that email is not registered with us</p>";
    }
    else {

        $sql = "INSERT INTO guestlist (idevent, idfriend) VALUES (11, $idfriend) WHERE idfriend = $idfriend";

        $db->exec($sql);
        echo "<p>Friend added to guest list</p>";
    }
}
else{
    echo  "<p>Please enter a search query</p>";
}

?>