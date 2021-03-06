<?php
session_start();


require_once '../Model/DB_connection.php';

$id = $_SESSION['id'];



//pull data info
$db = DB_connection::getDB();


//Pulling all messages for the the user from message and event table
$sql = "SELECT DISTINCT e.event_id, e.event_name
        FROM messages m JOIN events e
        WHERE $id = e.event_creator
        ORDER BY e.event_name";

$messages = $db->query($sql);

include 'header.php';

?>
    <main id="main" class="container">
        <form action="../Controller/addMessage.php" method="post" class="col-md-6 col-md-offset-3">
            <h1>Add New Message</h1>
            <div class="form-group">
                <label>Event:</label>
                <select name="event_id" class="form-control">
                    <option value="" selected>-- Select one --</option>
                    <?php foreach ($messages as $message) : ?>
                        <option value="<?php echo $message['event_id']; ?>"><?php echo $message['event_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="poster_id" value="<?php echo $id ?>" />
            <div class="form-group">
                <label>Subject: </label>
                <input type="input" name="subject" class="form-control" />
            </div>
            <div class="form-group">
                <label>Content: </label>
                <textarea class="messageBox form-control" name="content" rows="4" ></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-info btn-block" type="submit" value="Post Message" />
                <a href="messageIndex.php" class="btn btn-default btn-block">Cancel</a>
            </div>
        </form>
    </main>
<?php include 'footer.php' ?>