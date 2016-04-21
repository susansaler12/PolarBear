<?php
session_start();
//need to make a friends list
//the user needs to be able to search for a friend using email
//then the friendee is added to the friendslist table
//the status is 0 meaning that the friend is not confirmed
//if the friend request is accepted then the status should be 1
//if friend request is confirmed then friender and friendee should be able to view each others prof

require_once "../Model/database.php";
require_once "../Controller/validationLibrary.php";
$db = DB_connection::getDB();
$valid = new valLibrary();

class addfriendexception extends exception { }//

$_SESSION['id'] = 3; //this is the userid I manually put in so I don't get kicked out
//$userid=($_SESSION['id']);



//check to make sure that they are logged in
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


if(isset ($_POST['afriend']) && $_POST['afriend'] == 'Add Friend') {//get the email from the form
    $email = trim($_POST['email']);
    try {
        if (empty($email)) {//check for empty or invalid entries
            throw new addfriendexception ("Please enter your email");
        } else if (!($valid->checkEmail($email))) {//validate the email
            throw new addfriendexception ("Please enter a valid email");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    $idfriend = "SELECT id FROM user_profiles WHERE email = '$email'";//idfriend needs to be the id of the user
    //they are trying to friend from the user profiles page
    $result = $db->query($idfriend);
    $user = $result->fetch();}
if ($user == null)
{
    echo "<p>".'Sorry, that email is not registered with us'."</p>";
}
else {

    $userid = $_SESSION['id'];
    $sql = "INSERT INTO friendlist (id, idfriend, status) VALUES (:id, :idfriend,:status)";
    //booleans DO NOT accept nulls, need to be true or false, unless you change the database setup
    //our database is set up to automatically put status to null
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->bindValue(':id', $userid, PDO::PARAM_STR);
    $stm->bindValue(':idfriend', $user['id'], PDO::PARAM_STR);
    $stm->bindValue(':status', NULL, PDO::PARAM_STR);
    $row = $stm->execute();

    echo "<p>" . 'Friend request sent' . "</p>";
}

?>

