<?php

session_start();
require_once 'DB_connection.php';
//get info from database
$id = $_SESSION['id'];
$msg_id = $_POST['msg_id'];
//pull data info
$db = Dbclass::getDB();

//USE THIS TO PULL EVENT INFORMATION FOR EDIT
$sql = "SELECT * FROM messages WHERE msg_id= '$msg_id'";
$result = $db->query($sql);
$message = $result->fetch();

/*//USE THIS TO PULL EVENT ID/TITLE FOR EVENT DROPLIST
$query = "SELECT DISTINCT e.event_id, e.event_name
          FROM messages m JOIN events e
          WHERE $id = e.event_creator
          ORDER BY e.event_name";
$events = $db->query($query);*/

//Pulling all messages for the the user from message and event table
/*$sql = "SELECT e.event_id, e.event_name, m.msg_id, m.poster_id, m.subject, m.content
        FROM messages m JOIN events e
        WHERE $id = e.event_creator AND m.msg_id= '$msg_id'";
$result = $db->query($sql);
$message = $result->fetch();*/


 //var_dump($_POST);
?>
<?php include '../header.php' ?>
    <main id="main" class="container">
        <section class="section addMessage">
            <h1>Message Board</h1>
            <form action="updateMessage.php" method="post">
                <label>Event:</label>
                <input type="input" name="event_id" value="<?php echo $message['event_id']; ?>" /><br/>
                <!--<input disabled type="input"name="event_name"  value="<?php /*echo $message['event_name']; */?>" /><br/>-->
                <input type="hidden" name="msg_id" value="<?php echo $message['msg_id']; ?>" />
                <input type="hidden" name="poster_id" value="<?php echo $message['poster_id']; ?>" />
                <label>Subject: </label>
                <input type="input" name="subject" value="<?php echo $message['subject']; ?>" /><br/>
                <label>Content: </label>
                <textarea class="messageBox" name="content" rows="4" cols="50" ><?php echo $message['content']; ?></textarea><br/>
                <input type="hidden" name="post_date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                <div class="block">
                    <input class="btn" type="submit" value="Post Message" />
                </div>
            </form>
        </section>
    </main>
<?php include '../footer.php' ?>


