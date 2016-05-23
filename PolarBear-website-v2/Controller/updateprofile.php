<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
require_once "../Model/DB_connection.php";
require_once "../Model/valLibrary.php";
$db = DB_connection::getDB();

$valid = new valLibrary();

class updateprofileexception extends exception { }

if (isset ($_POST['uprofile']) && $_POST['uprofile'] == 'Update Profile') {


        $id = $_POST['id'];
        $email = trim($_POST['email']);
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $location = trim($_POST['location']);
        $birthday = $_POST['birthday'];
        $interests = $_POST['interests'];
        $image = $_POST['fimg'];

/*
        try {
            //email validation
            if (empty($email)) {
                throw new updateprofileexception ("Please enter your email");
            } else if (!($valid->checkEmail($email))) {
                throw new updateprofileexception ("Please enter a valid email");
            }
            //fname validation
            if (empty($fname)) {
                throw new updateprofileexception ("Please enter your first name");
            }
            //lname validation

            if (empty($lname)) {
                throw new updateprofileexception ("Please enter your last name");
            }

            //location catch

            if (empty($location)) {
                throw new updateprofileexception ("Please enter your postal code");
            } else if (!($valid->checkPostalCode($location))) {
                throw new updateprofileexception ("Please enter a valid postal code");
            }

            //birthday validation

            if (empty($birthday)) {
                throw new updateprofileexception ("Please enter your birthdate");
            } else if (!($valid->checkDate($birthday))) {
                throw new updateprofileexception ("Please enter the date in the following format yyyy-mm-dd");
            }


            //interests validate

            if (empty($interests)) {
                throw new updateprofileexception  ("Please enter a few interests");
            }
        }catch
        (exception $e){
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }


    /*THIS PART WAS ADDED FROM AN IN CLASS EXAMPLE*/
//get the variable values in superglobles $_FILES array
//need to save the images to a folder in the project and I can save the path to the image
//in the database
//path of the file in temp directory
    /*$file_temp = $_FILES['fimg']['tmp_name'];
    //original path and file name of the uploaded file
    $file_name = $_FILES['fimg']['name'];
    //size of the uploaded file in bytes
    $file_size = $_FILES['fimg']['size'];
    //type of the file(if browser provides)
    $file_type = $_FILES['fimg']['type'];
    //error number

    $file_error = $_FILES['fimg']['error'];


    if ($file_error > 0)
    {
        echo "Problem";
        switch ($file_error)
        {
            case 1:
                echo "File exceeded upload_max_filesize.";
                break;
            case 2:
                echo "File exceeded max_file_size";
                break;
            case 3:
                echo "File only partially uploaded.";
                break;
            case 4:
                echo "No file uploaded.";
                break;
        }
        exit;
    }
    class addimageexception extends exception { }
    $max_file_size = 300000;
    try {
        if ($file_size > $max_file_size) {
            throw new addimageexception ("file size too big");

        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    //This is the folder where the images will be saved
    $target_path = "../images/uploads/";
    $target_path = $target_path .  $_FILES['fimg']['name'];
    $image = $_FILES['fimg']['name'];
    //move the uploaded file from tempe path to taget path
    try {
        if(!move_uploaded_file($_FILES['fimg']['tmp_name'], $target_path)) {
            throw new addimageexception ("There was an error uploading the file, please try again!");
        }
    }
    catch (exception $e) {
        echo  $e->getMessage(), "\n";
    }*/

    $sql = "UPDATE user_profiles
            SET email = :email, fname = :fname, lname = :lname, image = :image, location = :location, birthday = :birthday, interests = :interests, full_name = CONCAT(:fname,' ',:lname)
            WHERE id = :id"; //need to put the variables in single quotes since these are strings if you are inserting variables
    //:name ect is a place holder that we use when we are going to user param statments to prevent sql injection
    //$row = $db->exec($sql); //use when you want to insert update and delete
    //use query statement only when you want to list things from the database
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    //the prepare statment is to make sure that no code commands are passed through to the webiste
    $stm->bindValue(':email', $email, PDO::PARAM_STR);
    $stm->bindValue(':fname', $fname, PDO::PARAM_STR);
    $stm->bindValue(':lname', $lname, PDO::PARAM_STR);
    $stm->bindValue(':image', $image, PDO::PARAM_STR);
    $stm->bindValue(':location', $location, PDO::PARAM_STR);
    $stm->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stm->bindValue(':interests', $interests, PDO::PARAM_STR);
    $stm->bindValue(':id', $id);


    //$row=$stm->execute(array(':fname' => $fname, ':lname' => $lname,':password'=> $password, ':image'=>$image, ':location'=> $location, ':birthday'=>$birthday, ':interests'=>$interests ));
    $row = $stm->execute();
    header("location:../View/showprofile.php");
    //var_dump($row);

}
?>