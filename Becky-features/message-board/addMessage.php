<?php
    // var_dump($_POST);

    $event_id = $_POST['event_id'];
    $poster_id = $_POST['poster_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];


    // Validate inputs
    if (empty($event_id) || empty($poster_id) || empty($subject) || empty($content)){
        $error = 'Invalid product data. Check all fields and try again.';
        include('error.php');
    } else {
        // If valid, add the product to the database
        require_once 'DB_connection.php';
        //pull data info
        $db = Dbclass::getDB();
        $sql = 'INSERT INTO messages
                      (event_id, poster_id, subject, content)
                    /* : is only a placeholder */
                    VALUE
                      (:event_id, :poster_id, :subject, :content)';

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
        header('location: index.php');
    }
?>