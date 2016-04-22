<?php

session_start();
require_once '../Model/DB_connection.php';
//pull data info
$db = DB_connection::getDB();
//$id = $_SESSION['id'];
$msg_id = $_POST['msg_id'];

//Pulling all messages for the the user from message and event table
$sql = "SELECT e.event_id, e.event_name, m.msg_id, m.poster_id, m.subject, m.content
        FROM messages m JOIN events e
        WHERE e.event_id = m.event_id AND m.msg_id= '$msg_id'";
$results = $db->query($sql);
$message = $results->fetch();


//var_dump($_POST);
?>
<?php include 'header.php' ?>
<main id="main" class="container">
    <section class="section addMessage">
        <h1>Message Board</h1>
        <form action="../Controller/updateMessage.php" method="post">
            <input type="hidden" name="msg_id" value="<?php echo $msg_id; ?>" /><br/>
            <label>Event:</label>
            <input disabled type="input" name="event_name" value="<?php echo $message['event_name']; ?>" /><br/>
            <label>Subject: </label>
            <input type="input" name="subject" value="<?php echo $message['subject']; ?>" /><br/>
            <label>Content: </label>
            <textarea class="messageBox" name="content" rows="4" cols="50" ><?php echo $message['content']; ?></textarea><br/>
            <div class="block">
                <a href="messageIndex.php" class="btn btn-default">Cancel</a><input class="btn btn-primary" type="submit" value="Post Message" />
            </div>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>


