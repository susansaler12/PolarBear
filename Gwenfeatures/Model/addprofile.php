<?php
var_dump($_POST);
require_once "../Model/database.php";
//require_once "../Controller/validationLibrary.php";



/*THIS PART WAS ADDED FROM AN IN CLASS EXAMPLE*/
//get the variable values in superglobles $_FILES array
//need to save the images to a folder in the project and I can save the path to the image
//in the database
//path of the file in temp directory
$file_temp = $_FILES['fimg']['tmp_name'];
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



$max_file_size = 200000;
if($file_size > $max_file_size)
{
    echo "file size too big";

}


if (isset ($_POST['aprofile'])&& $_POST['aprofile'] == 'Add Profile'){
    //this is pulling values from the form, local variables
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $password = trim($_POST['password']);
    $location = trim($_POST['location']);
    $birthday = $_POST['birthday'];
    $interests = $_POST['interests'];
    $image = $_POST['image'];


//This is the folder where the images will be saved
    $target_path = "uploads/";
    $target_path = $target_path .  $_FILES['fimg']['name'];

//move the uploaded file from tempe path to taget path
    if(move_uploaded_file($_FILES['fimg']['tmp_name'], $target_path)) {
        echo "The file ".  $_FILES['fimg']['name'] . " has been uploaded ";
    } else{
        echo "There was an error uploading the file, please try again!";
    }




    $sql = "INSERT INTO user_profiles
            (email, fname, lname, password, location, birthday, interests, image)
            VALUES (:email, :fname, :lname, :password, :location, :birthday, :interests, :image)"; //need to put the variables in single quotes since these are strings if you are inserting variables
    //:name ect is a place holder that we use when we are going to user param statments to prevent sql injection
    // $row = $db->exec($sql); //use when you want to insert update and delete
    //use query statement only when you want to list things from the database
    $stm = $db->prepare($sql); //this is called a prepared statement, we are using it instad of the exec statment
    $stm->bindValue(':email', $email, PDO::PARAM_STR);
    $stm->bindValue(':fname', $fname, PDO::PARAM_STR);
    $stm->bindValue(':lname', $lname, PDO::PARAM_STR);
    $stm->bindValue(':password', $password, PDO::PARAM_STR);
    $stm->bindValue(':location', $location, PDO::PARAM_STR);
    $stm->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stm->bindValue(':interests', $interests, PDO::PARAM_STR);
    $stm->bindValue(':image', $target_path, PDO::PARAM_STR);

    $row = $stm->execute();
    $message = "Inserted " . $row;
}
else{
   $message = "please enter values";
}
//header("location:listprofile.php");


?>