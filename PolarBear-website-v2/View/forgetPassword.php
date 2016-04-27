<?php
session_start();
require_once '../Model/valLibrary.php';
require_once '../Model/DB_connection.php';

$valid = new valLibrary();

$email = "";
$emailErr = "";
$summary = "";

//check if email is valid
if(isset($_POST['btnSubmit'])){
    $email = trim($_POST['email']);

    //pull data info
    $db = DB_connection::getDB();
    $query = "SELECT id, email, fname, password FROM user_profiles WHERE email = '$email'";
    $result = $db->query($query);
    $r = $result->fetch();

    if(empty($email)){
        $emailErr = "Please enter your email";
    } else if(!($valid->checkEmail($email))) {
        $emailErr = "Please enter a valid email";
    } else {
        //check if email on system
        if($r["email"] == $_POST['email']) {
            $id = $r['id'];
            $emailErr = "";
            $fname = $r["fname"];

            //random generate passwowrd
            $resetPassword = substr(sha1(uniqid(rand(),1)),3,8);
            $password = sha1($resetPassword); //encrypted version for database entry

            //GMAIL SETUP TO EMAIL USER WITH RANDOM PICK PASSWORD
            date_default_timezone_set('EST');
            require '../dependencies/PHPMailer/PHPMailerAutoload.php';
            //Create a new PHPMailer instance
            $mail = new PHPMailer;
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;
            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "gifts.polarbear@gmail.com";
            //Password to use for SMTP authentication
            $mail->Password = "PolarBear123!";
            //Set who the message is to be sent from
            $mail->setFrom('gifts.polarbear@gmail.com', 'Humber Student');
            //Set an alternative reply-to address
            $mail->addReplyTo('gifts.polarbear@gmail.com', 'Humber Student');
            //Set who the message is to be sent to
            $mail->addAddress("$email");
            //Set the subject line
            $mail->Subject = 'Polar Bear Gifts: Password reset request';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML("<p>Hi $fname,</p><p>Your password has been reset, please login and change your password as soon as possible.</p><p>Your new password is: <strong>$resetPassword</strong></p><p>Regards,<br/>Site Admin</p><img src='../images/emailLogo.png'/>");
            //Replace the plain text body with one created manually
            $mail->AltBody = 'Hi $fname,\n\nYour password has been reset, please login and change your password as soon as possible.\n\nYour new password is: ' . $resetPassword . '\n\nRegards,\nSite Admin';
            //Attach an image file
            //$mail->addAttachment('../images/emailLogo.png');
            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: Please try again.";
            } else {
                //UPDATE NEW PASSWORD INTO DATABASE
                require_once('../Model/loginDB.php');
                $ldb = new LoginDB();
                $ldb->updatePassword($id,$email,$password);

                //message to let user know email sent
                $summary = "<span class='text-success'>Reset password has been sent to $email";
            }
        } else {
            $summary = "<span class='text-danger'>Email not on system</span>";
        }
    }


}
require_once '../View/header.php';

//var_dump($_SESSION['loggedIn']);
?>

<main id="main">
    <div class="container">
        <form action="" method="post" class="col-md-4 col-md-offset-4">
            <h3>Password reset:</h3>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control input-lg" id="email" name="email" value="<?php echo $email ?>"/>
                <span id="emailErr" class="text-danger"><?php echo $emailErr ?></span>
            </div>
            <div class="show text-center form-group">
                <?php echo $summary; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info btn-block" id="btnSubmit" name="btnSubmit" value="Submit" />
            </div>
            <div class="show text-center">
                <a class="btn" href="login.php">Back to login</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../View/footer.php' ?>

