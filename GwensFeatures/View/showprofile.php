
<html>
<header>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Khand:400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/profilestyle.css">
</header>
<body>
<?php
//this is my page for showing 1 profile of a specific user
require_once "../Model/database.php";


$sql ="SELECT * FROM user_profiles WHERE id = 20"; //you dont have to name is query you can name it anything

$result = $db->query($sql);



foreach($result as $p){

    echo "<div class='Pname'>" . $p['fname'] . " " . $p['lname'] . "</div>";
    echo "<div class='Pinterests'>" . "Interests:" ." " . $p['interests'] . "</div>";
    echo "<div class='Pimage'>" . $p['image'] . "</div>";
        /*

        " : " . $p['location'] . " : " . $p['birthday'] .
        " : " . $p['interests'] . "</div>";
    $fupdate = "<form action ='updateprofileform.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='uprofile' value='UPDATE'/>".
        "</form>";
    echo $fupdate . "<div>";
    $fdelete = "<form action ='deleteprofile.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='dprofile' value='DELETE'/>".
        "</form>";
    echo $fdelete . "<div>";
        */
}

?>



</body>
</html>
