<?php
session_start();
// connect database
require_once '../Model/DB_connection.php';

$id = $_SESSION['id'];

//pull data info
$db = DB_connection::getDB();
// pull data from database
$sql = "SELECT e.event_id, e.event_name, m.msg_id, m.poster_id, m.subject, m.content, m.post_date
        FROM messages m JOIN events e
        WHERE e.event_id = m.event_id AND m.poster_id = '$id'
        ORDER BY m.post_date DESC ";
$messages = $db->query($sql);
//var_dump($messages);
include 'header.php';

//check if logged in
if($_SESSION['loggedIn'] == true)
{
    echo "<a href='../Controller/logout.php'>Logout</a>";
} else {
    echo "<a href='login.php'>Login</a>";
    //header("location:/login/login.php");
}

?>


    <main id="main" class="container">
        <section>
            <div class="row">
                <h1 class="pull-left">Message Board</h1>
                <!-- add new message button -->
                <form action="addMessageForm.php" class="pull-right" >
                    <input class="btn" type="submit" value="Post New Message" >
                </form>
            </div>
            <?php foreach ($messages as $message) : ?>
                <hr>
                <div class="row">
                    <h3><?php echo $message['subject']; ?></h3>
                    <div class="pull-right"><?php echo $message['post_date']; ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <?php echo $message['event_name']; ?>
                    </div>
                    <div class="col-sm-8">
                        <?php echo $message['content']; ?>
                    </div>
                    <div class="col-sm-2">
                        <!-- Delete button starts here -->
                        <form class="pull-right" action="../Controller/deleteMessage.php" method="post" onsubmit="return confirm('Are you sure you want to delete this message?');" >
                            <input type="hidden" name="msg_id"
                                   value="<?php echo $message['msg_id']; ?>" />
                            <input type="submit" value="Delete" />
                        </form>
                        <!-- Edit button starts here -->
                        <form class="pull-right" action="updateMessageForm.php" method="post" >
                            <input type="hidden" name="msg_id"
                                   value="<?php echo $message['msg_id']; ?>" />
                            <input type="submit" value="Edit" />
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
<?php include 'footer.php' ?>