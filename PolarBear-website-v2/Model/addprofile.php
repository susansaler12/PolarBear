<?php
//Hey Gwen! it's Jon. Here's the new sqlquery $sql **xx


//WARNING: if you change a single line on this thing it will totally break
//back it up before you do ANYTHING
session_start();
require_once "../Model/DB_connection.php";
require_once "../Model/valLibrary.php";
$db = DB_connection::getDB();

$valid = new valLibrary();
class addprofileexception extends exception { }
//make sure they can't do sql statements
//put the error in try/catch statments
if (isset ($_POST['aprofile'])&& $_POST['aprofile'] == 'Add Profile') {
    //this is pulling values from the form, local variables
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $passwordIn = trim($_POST['password']);
    $location = trim($_POST['location']);
    $birthday = $_POST['birthday'];
    $interests = $_POST['interests'];
    try {
        //email validation
        if (empty($email)) {
            throw new addprofileexception ("Please enter your email");
        } else if (!($valid->checkEmail($email))) {
            throw new addprofileexception ("Please enter a valid email");
        }
        //fname validation
        if (empty($fname)) {
            throw new addprofileexception ("Please enter your first name");
        }
        //lname validation

        if (empty($lname)) {
            throw new addprofileexception ("Please enter your last name");
        }

        //password validation

        if (empty($passwordIn)) {
            throw new addprofileexception ("Please create a password");
        } else if ((strlen($passwordIn) < 8)) {
            throw new addprofileexception ("Password must be more than eight characters");
        } else {
            $password = sha1($passwordIn, false);
        }

        //location catch

        if (empty($location)) {
            throw new addprofileexception ("Please enter your postal code");
        } else if (!($valid->checkPostalCode($location))) {
            throw new addprofileexception ("Please enter a valid postal code");
        }

        //birthday validation

        if (empty($birthday)) {
            throw new addprofileexception ("Please enter your birthdate");
        } else if (!($valid->checkDate($birthday))) {
            throw new addprofileexception ("Please enter the date in the following format yyyy-mm-dd");
        }


        //interests validate

        if (empty($interests)) {
            throw new addprofileexception  ("Please enter a few interests");
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
$target_path = "../uploads/";
$target_path = $target_path .  $_FILES['fimg']['name'];
$image = $_FILES['fimg']['name'];
//move the uploaded file from tempe path to taget path
try {if(move_uploaded_file($_FILES['fimg']['tmp_name'], $target_path)) {
    throw new addimageexception ("The file ".  $_FILES['fimg']['name'] . " has been uploaded ");

} else{
    throw new addimageexception ("There was an error uploading the file, please try again!");
}
} catch (exception $e) {
    echo  $e->getMessage(), "\n";
}

/*
 * public static function AddWishlist($product_id, $user_id)
    {
        $db = Database::getDB();

        $query = "INSERT INTO wishlist (product_id, user_id)
                  VALUES ($product_id, $user_id)";

        $row_count = $db->exec($query);
        return $row_count;

    }
}
 */
//public static function setProfile() {
//   $db = DB_connection::getDB();
//**xx
$sql = "INSERT INTO user_profiles
            (email, fname, lname, password, location, birthday, interests, image, full_name)
            VALUES (:email, :fname, :lname, :password, :location, :birthday, :interests, :image, concat(:fname,' ',:lname))"; //need to put the variables in single quotes since these are strings if you are inserting variables
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
$stm->bindValue(':image', $image, PDO::PARAM_STR);

$row = $stm->execute();

//$message = "Inserted " . $row;

//}

//header("location:listprofile.php");


?>