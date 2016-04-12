<?php
require_once '../valLibrary.php';
require_once 'dbclass.php';

$valid = new valLibrary();

//pull global data
$_SESSION['email'] = "";
$_SESSION['password'] = "";
$_SESSION['loggedIn'] = false;

$emailIn = "";
$passwordIn = "";
$emailErr = "";
$passwordErr = "";
$errorLogin = "";

//check if email is valid
if(isset($_POST['email'])){
    $id = "";
    $fname = "";
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        $emailErr = "Please enter your email";
    } else if(!($valid->checkEmail($email))){
        $emailErr = "Please enter a valid email";
    }

    if(empty($password)){
        $passwordErr = "Please enter your password";
    }

    if(!empty($email) && (!empty($password))){

        //verifying user email and password
        session_start();

        //how to work with checking user and password
        $db = Dbclass::getDB();
        $query = "SELECT * FROM user_profiles WHERE email = '$email' AND password = '$password'";
        $result = $db->query($query);
        $r = $result->fetch();

        if($r["email"] == $_POST['email'] && $r["password"] == $_POST['password'])
        {
            $emailIn = $_POST['email'];
            $passwordIn = $_POST['password'];

            $_SESSION['id'] = $r['id'];
            $_SESSION['fname'] = $r['fname'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['loggedIn'] = true;

            echo "login success";
            //header("location:../message-board/index.php");
        }
        else {
            $errorLogin = "Invalid username / password, please try again";

        }
    }

}

include '../header.php';

?>

<main id="main">
    <div class="page-wrapper">
        <form action="" method="post">

            <label for="email">Email:</label><br/>
            <input type="text" id="email" name="email" value="<?php echo $emailIn ?>"/><br/>
            <span id="emailErr" class="main-form-span"><?php echo $passwordIn ?></span><br/>

            <label for="password">Password:</label><br/>
            <input type="text" id="password" name="password" value="<?php echo $_POST['password']; ?>"/><br/>
            <span id="passwordErr"><?php echo $passwordErr; ?></span><br/>

            <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" /><br/><br/>
            <span><?php echo $errorLogin; ?></span>
        </form>
    </div>
</main>

<?php include '../footer.php' ?>

