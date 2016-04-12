<?php
require_once "../Model/database.php";
$id = $_POST['id'];// need this to get id value

$sql="SELECT * FROM user_profiles WHERE id='$id'";//its very important to have the thing after the equals sign in single quotes otherwise EVERYTHING will break


$result=$db->query($sql);
$user_profiles = $result->fetch();

?>
<!--This is the form for entering the new values for the profile-->
<form action="../Model/updateprofile.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user_profiles ['id'];?>"/>
    Email <input type="text" name="email" value="<?php echo $user_profiles['email'];?>"> <br />
    First name<input type="text" name="fname" value="<?php echo $user_profiles['fname'];?>"> <br />
    Last name<input type="text" name="lname" value="<?php echo $user_profiles['lname'];?>"> <br />
    Password<input type="password" name="password" value="<?php echo $user_profiles['password'];?>"><br />
    Postal code <input type="text" name="location" value="<?php echo $user_profiles['location'];?>"><br />
    Birthday <input type="date" name="birthday" value="<?php echo $user_profiles['birthday'];?>"><br />
    Interests <input type="text" name="interests" value="<?php echo $user_profiles['interests'];?>"><br />
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    Select an image to upload: <input type="file" name="fimg" id="fimg" ><br />
    <input type="submit" value="Update Profile" name="uprofile"> <!--it always needs to have a name -->
</form>
<?php


?>
