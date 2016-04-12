<?php

require_once "../Model/database.php";
$_SESSION['id']=8;//this is the userid I manually put in so I don't get kicked out
$user=($_SESSION['id']);

//this is the action on the accept friend button click, if button clicked then status is set to 1 in friendlist
//this means that now the two users are friends
if (isset ($_POST['confirmfriend']) && $_POST['confirmfriend'] == 'Accept Friend Request') {
    $query = "UPDATE friendlist
    SET status=1
    WHERE id='$user'";
    $db->exec($query);
    echo "Friend request accepted";
}
else{
    echo"a problem has occured, please try again";
}

?>