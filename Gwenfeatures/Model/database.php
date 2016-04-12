<?php
$dsn = 'mysql:host=localhost;dbname=polarbear'; //database name needs to be entered NEVER PUT SPACES IN HERE
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
   // echo "connected";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message; //this will display the error message for you
    //include('errorprofile.php');
    exit();
}
?>