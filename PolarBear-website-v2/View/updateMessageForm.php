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
    <form action="../Controller/updateMessage.php" method="post" class="col-md-6 col-md-offset-3">
        <h1>Message Board</h1>
        <input type="hidden" name="msg_id" value="<?php echo $msg_id; ?>" />
        <div class="form-group">
            <label>Event:</label>
            <input disabled class="form-control" type="input" name="event_name" value="<?php echo $message['event_name']; ?>" />
        </div>
        <div class="form-group">
            <label>Subject: </label>
            <input class="form-control" type="input" name="subject" value="<?php echo $message['subject']; ?>" />
        </div>
        <div class="form-group">
            <label>Content: </label>
            <textarea class="messageBox form-control" name="content" rows="4" cols="50" ><?php echo $message['content']; ?></textarea>
        </div>
        <div class="form-group">
            <input class="btn btn-info btn-block" type="submit" value="Post Message" />
            <a href="messageIndex.php" class="btn btn-default btn-block">Cancel</a>
        </div>
    </form>
</main>
<?php include 'footer.php' ?>


