<?php
date_default_timezone_set('Canada/Eastern');
    // Get the message data
    $msg_id = $_POST['msg_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $phptime = time();
    $mysqltime = date("Y-m-d H:i:s", $phptime);

    // Validate inputs
    if (empty($msg_id) || empty($subject) || empty($content)) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../View/messageError.php');
    } else {
        // If valid, update the product to the database
        require_once('../Model/messageDB.php');
        $mdb=new MessageDB();
        $mdb->updateMessage($msg_id,$subject,$content,$mysqltime);

        // Display the Product List page
        header('location: ../View/messageIndex.php');
    }
?>