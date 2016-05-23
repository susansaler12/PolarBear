<?php
//this is the page for adding new profiles to the table
require_once '../View/header.php';
?>
<!--This is the form that needs to be filled out and submitted to add new information to the table-->
<div class="container">
    <div class="row">
        <form action="../Model/addprofile.php" method="post" enctype="multipart/form-data" class="col-md-6 col-md-offset-3">
            <div class="row">
                <h1>Register an Account:</h1>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" id="fname" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" id="lname" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="location">Postal Code:</label>
                        <input type="text" name="location" id="location" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="text" name="birthday" id="birthday" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="interests">Interests:</label>
                        <input type="text" name="interests" id="interests" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                        <label for="interests">Profile Image:</label>
                        <input type="file" name="fimg" id="fimg" class="form-control"/>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <input type="submit" value="Add Profile" id="aprofile" name="aprofile" class="btn btn-info btn-block"> <!--it always needs to have a name -->
                    <a href="index1.php" class="btn btn-default btn-block">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once '../View/footer.php';?>
