<?php
session_start();


require_once 'database.php';

$id = $_SESSION['id'];

// pull data from database
//MAKE SURE TO PULL FROM EVENT TABLE INSTEAD
$sql = "SELECT * FROM messages WHERE poster_id = '$id' ORDER BY event_id ASC, msg_id ASC";

$messages = $db->query($sql);

include '../header.php';

?>
    <main id="main" class="container">
        <section class="section addMessage">
            <h1>Add New Message</h1>
            <form action="addMessage.php" method="post" >
                <label>Event:</label>
                <select name="event_id">
                    <option value="" selected>-- Select one --</option>
                    <?php foreach ($messages as $message) : ?>
                        <option value="<?php echo $message['event_id']; ?>"><?php echo $message['event_id']; ?></option>
                    <?php endforeach; ?>
                </select><br/>
                <input type="hidden" name="poster_id" value="<?php echo $id ?>" />
                <label>Subject: </label>
                <input type="input" name="subject"/><br/>
                <label>Content: </label>
                <textarea class="messageBox" name="content" rows="4" ></textarea><br/>
                <div class="block">
                    <input class="btn" type="submit" value="Post Message" />
                </div>
            </form>
        </section>
    </main>
<?php include '../footer.php' ?>