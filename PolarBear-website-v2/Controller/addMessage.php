<?php
date_default_timezone_set('Canada/Eastern');

    $event_id = $_POST['event_id'];
    $poster_id = $_POST['poster_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $phptime = time();
    $mysqltime = date("Y-m-d H:i:s", $phptime);


    // Validate inputs
    if (empty($event_id) || empty($poster_id) || empty($subject) || empty($content)){
        $error = 'Invalid product data. Check all fields and try again.';
        include('../View/messageError.php');
    } else {
        // If valid, add the product to the database
        require_once '../Model/DB_connection.php';
        //pull data info
        $db = DB_connection::getDB();
        $sql = "INSERT INTO messages
                      (event_id, poster_id, subject, content, post_date)
                    /* : is only a placeholder */
                    VALUES
                      (:event_id, :poster_id, :subject, :content, '$mysqltime')";

        //prepare to strip all coding to avoid hacking
        //and any 'droptable' hack coding
        $stm = $db->prepare($sql);
        //first argument, can be more straight for security with PDO
        $stm->bindParam(':event_id', $event_id, PDO::PARAM_INT, 11);
        $stm->bindParam(':poster_id', $poster_id, PDO::PARAM_INT, 11);
        $stm->bindParam(':subject', $subject, PDO::PARAM_STR, 100);
        $stm->bindParam(':content', $content, PDO::PARAM_STR, 3000);

        $row = $stm->execute();
        // Display the Product List page
        header('location: ../View/messageIndex.php');
    }
?>