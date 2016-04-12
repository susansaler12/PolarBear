<?php
//this is the page for adding new profiles to the table

?>
<!--This is the form that needs to be filled out and submitted to add new information to the table-->
<form action="../Model/addprofile.php" method="post" enctype="multipart/form-data">
    Email<input type="text" name="email"> <br />
    First name<input type="text" name="fname"><br />
    Last Name<input type="text" name="lname"><br />
    Password<input type="password" name="password"><br />
    Postal Code<input type="text" name="location"><br />
    Birthday<input type="text" name="birthday"><br />
    Interests<input type="text" name="interests"><br />


    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    Select an image to upload: <input type="file" name="fimg" id="fimg" ><br />


  <input type="submit" value="Add Profile" name="aprofile"> <!--it always needs to have a name -->
</form>
