<?php
session_start();
require_once '../Model/valLibrary.php';
require_once '../Model/DB_connection.php';

$valid = new valLibrary();

$email = "";
$passwordIn = "";
$emailErr = "";
$passwordErr = "";
$errorLogin = "";

//check if email is valid
if(isset($_POST['btnSubmit'])){
    $id = "";
    $email = trim($_POST['email']);
    $passwordIn = trim($_POST['password']);
    $password = sha1($passwordIn, false);

    //pull data info
    $db = DB_connection::getDB();
    $query = "SELECT * FROM user_profiles WHERE email = '$email' AND password = '$password'";
    $result = $db->query($query);
    $r = $result->fetch();

    if(empty($email)){
        $emailErr = "Please enter your email";
    } else if(!($valid->checkEmail($email))){
        $emailErr = "Please enter a valid email";
    }

    if(empty($passwordIn)){
        $passwordErr = "Please enter your password";
    }

    //checking user and password
    if(!empty($email) && (!empty($passwordIn))){

        if($r['email'] == $email && $r['password'] == $password)
        {
            $_SESSION['id'] = $r['id'];
            $_SESSION['fname'] = $r['fname'];
            $_SESSION['loggedIn'] = true;
            //TEMPT LOCATION TO CHECK IF LOGGED IN OR NOT

            //check if logged in
            /*if(isset($_SESSION['id']))
            {
                echo "<a href='logout.php'>Logout</a>";
                //DO WHATEVER YOU WANT, LIKE REDIRECT TO PAGE
                //header("location:../message-board/index.php");
            }*/
            header("location:showprofile.php");
            exit();
        }
        else {
            $errorLogin = "Invalid username / password, please try again";
        }
    }
}

require_once "../View/header.php";
?>

<main id="main" class="container">
    <form action="" method="post" class="col-md-4 col-md-offset-4">
        <h1>Login:</h1>
        <div class="form-group">
            <label for="email">Email: </label>
            <input type="text" class="form-control input-lg" id="email" name="email" value="<?php echo $email ?>"/>
            <span id="emailErr" class="text-danger"><?php echo $emailErr ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" class="form-control input-lg" id="password" name="password" value="<?php echo $passwordIn ?>"/>
            <span id="passwordErr" class="text-danger"><?php echo $passwordErr; ?></span>
        </div>
        <span class="show text-danger text-center form-group">
            <?php echo $errorLogin; ?>
        </span>
        <div class="form-group">
            <input type="submit" class="btn btn-info btn-block" id="btnSubmit" name="btnSubmit" value="Login" />
        </div>
        <div class="show text-center">
            <a class="btn" href="forgetPassword.php">Forget password?</a> | <a class="btn" href="addprofileform.php">Make an Account</a>
        </div>
    </form>
</main>

<?php require_once "../View/footer.php"; ?>

