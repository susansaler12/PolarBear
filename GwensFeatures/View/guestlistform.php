<?php
//step 1- have user search for guest with email using a form
//step 2 have that guest added to an array on button click
//step 3 have guests displayed


?>
<html>
<head>
<title>Guest List</title>
</head>
<h1>Add a Guest to Guest List</h1>
<!--This is the form users need to fill out to search for emails-->
<form action="../Model/guestlist.php" method="post">
Email<input type="text" name="email"> <br />
<input type="submit" value="Add Guest" name="aguest"> <!--it always needs to have a name -->
</form>

</html>