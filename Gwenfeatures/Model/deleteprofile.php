<?php

var_dump($_POST);
require_once "../Model/database.php";
if (isset ($_POST['dprofile']) && $_POST['dprofile'] == 'DELETE') {
    $id = $_POST['id'];

    $query = "DELETE FROM user_profiles
          WHERE id = $id";
    $db->exec($query);
    header("location:listprofile.php");
}
?>