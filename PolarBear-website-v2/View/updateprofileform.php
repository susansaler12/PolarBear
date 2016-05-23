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
<div class="container">
    <form action="../Controller/updateprofile.php" method="post" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
        <h1>Update Profile</h1>

        <input type="hidden" name="id" value="<?php echo $user_profiles ['id'];?>"/>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control input-lg" <?php echo 'value=' . $user_profiles['email'];?>>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" class="form-control input-lg" <?php echo 'value=' . $user_profiles['fname'];?>>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" class="form-control input-lg" <?php echo 'value=' . $user_profiles['lname'];?>>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="location">Postal Code:</label>
                <input type="text" name="location" id="location" class="form-control input-lg" <?php echo 'value=' . $user_profiles['location'];?>>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="text" name="birthday" id="birthday" class="form-control input-lg" <?php echo 'value=' .  $user_profiles['birthday'];?>>
            </div>
            <div class="form-group">
                <label for="interests">Interests:</label>
                <input type="text" name="interests" id="interests" class="form-control input-lg" <?php echo 'value=' . $user_profiles['interests'];?>>
            </div>
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <label for="interests">Profile Image:</label>
                <input type="file" name="fimg" id="fimg" class="form-control input-lg"/>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Update Profile" id="aprofile" name="uprofile" class="btn btn-info btn-block"> <!--it always needs to have a name -->
        </div>
    </form>
</div>

<?php
require_once "footer.php";
?>
