
<html>
<?php
//this is our list page
require_once "../Model/database.php";


$sql ="SELECT * FROM user_profiles"; //you dont have to name is query you can name it anything

$result = $db->query($sql);

//var_dump($result->fetchAll());

foreach($result as $p){
    echo "<div>" . $p['email'] . " : " .
        $p['fname'] . " : " . $p['lname'] . " : "  . $p['password'] . " : "  . $p['image'] .
        " : " . $p['location'] . " : " . $p['birthday'] .
        " : " . $p['interests'] . "</div>";
    $fupdate = "<form action ='../View/updateprofileform.php' method='post'>" .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='uprofile' value='UPDATE'/>".
        "</form>";
    echo $fupdate . "<div>";

    $fdelete = '<form action ="../Model/deleteprofile.php" method="post">' .
        "<input type='hidden' name='id' value='" . $p['id'] . "' />".
        "<input type='submit' name='dprofile' value='DELETE'/>".
        "</form>";
    echo $fdelete . "<div>";
}

?>



</body>
</html>
