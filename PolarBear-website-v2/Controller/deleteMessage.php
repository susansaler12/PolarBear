<?php
    //get message id
    $msg_id = $_POST['msg_id'];

    // Delete the product from the database
    require_once('../Model/DB_connection.php');
    //pull data info
    $db = DB_connection::getDB();
    $sql = "DELETE FROM messages
              WHERE msg_id = '$msg_id'";

    //update delete will show how many rows affected
    $db->exec($sql);

    // display the Product List page
    header('location: ../View/messageIndex.php');

?>