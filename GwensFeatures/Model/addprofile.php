<?php
//WARNING: if you change a single line on this thing it will totally break
//back it up before you do ANYTHING

require_once "../Model/database.php";
require_once "../Controller/validationLibrary.php";
$db = DB_connection::getDB();

$valid = new valLibrary();
class addprofileexception extends exception { }
//make sure they can't do sql statements
//put the error in try/catch statments
if (isset ($_POST['aprofile'])&& $_POST['aprofile'] == 'Add Profile') {
    //this is pulling values from the form, local variables
    //email trim and validation
    $email = trim($_POST['email']);
    try {
        if (empty($email)) {
            throw new addprofileexception ("Please enter your email");
        } else if (!($valid->checkEmail($email))) {
            throw new addprofileexception ("Please enter a valid email");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    //fname trim and validation
    $fname = trim($_POST['fname']);
    try {
        if (empty($fname)) {
            throw new addprofileexception ("Please enter your first name");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    //lname trim and validation
    $lname = trim($_POST['lname']);
    try {
        if (empty($lname)) {
            throw new addprofileexception ("Please enter your last name");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    //password trim and validation
    $password = trim($_POST['password']);
    try {
        if (empty($password)) {
            throw new addprofileexception ("Please create a password");
        } else if ((strlen($password) < 8)) {
            throw new addprofileexception ("Password must be more than eight characters");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

    //location try and catch
    $location = trim($_POST['location']);
    try {
        if (empty($location)) {
            throw new addprofileexception ("Please enter your postal code");
        } else if (!($valid->checkPostalCode($location))) {
            throw new addprofileexception ("Please enter a valid postal code");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    //birthday try and catch
    $birthday = $_POST['birthday'];
    try {
        if (empty($birthday)) {
            throw new addprofileexception ("Please enter your birthdate");
        } else if (!($valid->checkDate($birthday))) {
            throw new addprofileexception ("Please enter the date in the following format yyyy-mm-dd");
        }
    } catch (exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}
    //interests trim and validate
    $interests = $_POST['interests'];
   try {if (empty($interests)) {
       throw new addprofileexception  ("Please enter a few interests");
    }
   }catch (exception $e){
       echo 'Caught exception: ',  $e->getMessage(), "\n";
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
    $stm->bindValue(':image', $image, PDO::PARAM_STR);

    $row = $stm->execute();

//$message = "Inserted " . $row;

//}

//header("location:listprofile.php");


?>