<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
require_once "../Model/DB_connection.php";
$id = $_SESSION['id'];// need this to get id value

$sql="SELECT * FROM user_profiles WHERE id='$id'";//its very important to have the thing after the equals sign in single quotes otherwise EVERYTHING will break

$db = DB_connection::getDB();
$result=$db->query($sql);
$user_profiles = $result->fetch();
require_once "header.php";
?>
<!--This is the form for entering the new values for the profile-->
<form action="../Controller/updateprofile.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $user_profiles ['id'];?>"/>
    Email <input type="text" name="email" value="<?php echo $user_profiles['email'];?>"> <br />
    First name<input type="text" name="fname" value="<?php echo $user_profiles['fname'];?>"> <br />
    Last name<input type="text" name="lname" value="<?php echo $user_profiles['lname'];?>"> <br />
    Postal code <input type="text" name="location" value="<?php echo $user_profiles['location'];?>"><br />
    Birthday <input type="date" name="birthday" value="<?php echo $user_profiles['birthday'];?>"><br />
    Interests <input type="text" name="interests" value="<?php echo $user_profiles['interests'];?>"><br />

    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    Select an image to upload: <input type="file" name="fimg" id="fimg" ><br />
    <input type="submit" value="Update Profile" name="uprofile"> <!--it always needs to have a name -->
</form>
<?php
require_once "footer.php";
?>
