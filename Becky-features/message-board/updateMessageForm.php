<?php

require_once 'dbclass.php';
//get info from database
$msg_id = $_POST['msg_id'];
$db = Dbclass::getDB();

//USE THIS TO PULL EVENT INFORMATION FOR EDIT
$sql = "SELECT * FROM messages WHERE msg_id= '$msg_id'";
$result = $db->query($sql);
$message = $result->fetch();

//USE THIS TO PULL EVENT ID/TITLE FOR EVENT DROPLIST
$sql = "SELECT * FROM messages WHERE poster_id = '$id' ORDER BY event_id ASC, msg_id ASC";
$eventsList = $db->query($sql);


 //var_dump($_POST);
?>
<?php include '../header.php' ?>
    <main id="main" class="container">
        <section class="section addMessage">
            <h1>Message Board</h1>
            <form action="updateMessage.php" method="post">
                <label>Event:</label>
                <select name="event_id">
                    <option value="" selected>-- Select one --</option>
                    <?php foreach ($eventsLists as $eventsList) : ?>
                        <option value="<?php echo $eventsList['event_id']; ?>"><?php echo $eventsList['event_id']; ?></option>
                    <?php endforeach; ?>
                </select><br/>
                <!-- <input disabled type="input" name="event_id" value="<?php /*echo $message['event_id'];*/ ?>" /><br/> -->
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


