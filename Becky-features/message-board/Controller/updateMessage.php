<?php
    // Get the message data
    $event_id = $_POST['event_id'];
    $msg_id = $_POST['msg_id'];
    $poster_id = $_POST['poster_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $post_date = $_POST['post_date'];

    // Validate inputs
    if (empty($event_id) || empty($msg_id) ||empty($poster_id) || empty($subject) || empty($content)) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../View/messageError.php');
    } else {
        // If valid, update the product to the database
        require_once('../Model/messageDB.php');
        $mdb=new MessageDB();
        $mdb->updateMessage($event_id,$msg_id,$poster_id,$subject,$content,$post_date);

        // Display the Product List page
        header('location: ../View/messageIndex.php');
    }
?>