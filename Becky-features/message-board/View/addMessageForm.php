<?php
session_start();


require_once '../Model/DB_connection.php';

$id = $_SESSION['id'];



//pull data info
$db = Dbclass::getDB();


//Pulling all messages for the the user from message and event table
$sql = "SELECT DISTINCT e.event_id, e.event_name
        FROM messages m JOIN events e
        WHERE $id = e.event_creator
        ORDER BY e.event_name";

$messages = $db->query($sql);

include 'header.php';

?>
    <main id="main" class="container">
        <section class="section addMessage">
            <h1>Add New Message</h1>
            <form action="../Controller/addMessage.php" method="post" >
                <label>Event:</label>
                <select name="event_id">
                    <option value="" selected>-- Select one --</option>
                    <?php foreach ($messages as $message) : ?>
                        <option value="<?php echo $message['event_id']; ?>"><?php echo $message['event_name']; ?></option>
                    <?php endforeach; ?>
                </select><br/>
                <input type="hidden" name="poster_id" value="<?php echo $id ?>" />
                <label>Subject: </label>
                <input type="input" name="subject"/><br/>
                <label>Content: </label>
                <textarea class="messageBox" name="content" rows="4" ></textarea><br/>
                <div class="block">
                    <a href="messageIndex.php" class="btn btn-default">Cancel</a><input class="btn btn-primary" type="submit" value="Post Message" />
                </div>
            </form>
        </section>
    </main>
<?php include 'footer.php' ?>