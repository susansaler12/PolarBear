<?php
//this is the page for adding new profiles to the table
require_once '../View/header.php';
?>
<!--This is the form that needs to be filled out and submitted to add new information to the table-->
<div class="container">
    <form action="../Model/addprofile.php" method="post" enctype="multipart/form-data" class="col-md-8 col-md-offset-2">
        <h1>Register an Account:</h1>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control input-lg"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="location">Postal Code:</label>
                <input type="text" name="location" id="location" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="text" name="birthday" id="birthday" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label for="interests">Interests:</label>
                <input type="text" name="interests" id="interests" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <label for="interests">Profile Image:</label>
                <input type="file" name="fimg" id="fimg" class="form-control input-lg"/>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Add Profile" id="aprofile" name="aprofile" class="btn btn-info btn-block"> <!--it always needs to have a name -->
        </div>
    </form>
</div>
<?php require_once '../View/footer.php';?>
