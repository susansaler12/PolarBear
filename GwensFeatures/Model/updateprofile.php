<?php
//var_dump($_POST);
require_once "../Model/database.php";
require_once "../Controller/validationLibrary.php";
$db = DB_connection::getDB();

$valid = new valLibrary();

if (isset ($_POST['uprofile']) && $_POST['uprofile'] == 'Update Profile') {
    echo "form submit";
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $image = $_POST['image'];
    $location = $_POST['location'];
    $birthday = $_POST['birthday'];
    $interests = $_POST['interests'];//this is pulling values from the form, local variables

    $sql="UPDATE user_profiles
            SET email = :email, fname = :fname, lname = :lname, password = :password, image = :image, location = :location, birthday = :birthday, interests = :interests
            WHERE id = :id"; //need to put the variables in single quotes since these are strings if you are inserting variables
    //:name ect is a place holder that we use when we are going to user param statments to prevent sql injection
     //$row = $db->exec($sql); //use when you want to insert update and delete
    //use query statement only when you want to list things from the database
   $stm=$db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->bindValue(':id', $id);//the prepare statment is to make sure that no code commands are passed through to the webiste
    $stm->bindValue(':email', $email, PDO::PARAM_STR);
    $stm->bindValue(':fname', $fname, PDO::PARAM_STR);
    $stm->bindValue(':lname', $lname, PDO::PARAM_STR);
    $stm->bindValue(':password', $password, PDO::PARAM_STR);
    $stm->bindValue(':image', $image, PDO::PARAM_STR);
    $stm->bindValue(':location', $location, PDO::PARAM_STR);
    $stm->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stm->bindValue(':interests', $interests, PDO::PARAM_STR);


  //$row=$stm->execute(array(':fname' => $fname, ':lname' => $lname,':password'=> $password, ':image'=>$image, ':location'=> $location, ':birthday'=>$birthday, ':interests'=>$interests ));
    $row = $stm->execute();
    echo "Updates " . $row;
    //var_dump($row);
}
else{
    echo "please enter values";
}
header("location:listprofile.php");
?>