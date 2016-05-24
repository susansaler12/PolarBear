<?php
require_once "../Controller/session_start.php";

$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

require_once '../Model/DB_connection.php';
$id = $_SESSION['id'];

//pull data info
$db = DB_connection::getDB();
// pull data from database if its creator
$sql = "SELECT e.event_id, e.event_name, m.msg_id, m.poster_id, m.subject, m.content, m.post_date
        FROM messages m JOIN events e
        WHERE e.event_id = m.event_id AND m.poster_id = '$id'
        ORDER BY m.post_date DESC ";
$messages = $db->query($sql);
$r = $messages->fetch();

$isUpdate = false;
if($r > 0){
    $isUpdate = true;
}
//pull data if its invitee
$query = "SELECT DISTINCT e.event_id, e.event_name, m.msg_id, m.subject, m.content, m.post_date, i.invitee
        FROM messages m JOIN events e JOIN invites i
        WHERE e.event_id = m.event_id AND m.event_id = i.event_id
        ORDER BY m.post_date DESC ";
$greetings = $db->query($query);

//var_dump($messages);
require_once 'header.php';

?>


    <main id="main" class="container messageBoard">
    <?php if($isUpdate) : ?>
        <div class="row">
            <h1>Message Board</h1>
            <!-- add new message button -->
            <form action="addMessageForm.php">
                <input class="btn btn-info pull-right" type="submit" value="Post New Message" >
            </form>
        </div>
        <hr/>
        <?php foreach ($messages as $message) : ?>
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <h2><?php echo $message['subject']; ?></h2>
                    <?php echo $message['content']; ?>
                </div>
                <div class="col-md-4 col-sm-5 text-right">
                    <span class="text-primary"><?php echo $message['event_name']; ?></span><br/>
                    <small><?php echo $message['post_date']; ?></small>
                    <div class="row">
                        <!-- Edit/ delete button starts here -->
                        <div class="col-sm-3 col-xs-6 pull-right nopadding">
                            <form action="../Controller/deleteMessage.php" method="post" onsubmit="return confirm('Are you sure you want to delete this message?');" >
                                <input type="hidden" name="msg_id" value="<?php echo $message['msg_id']; ?>" />
                                <input class="btn btn-default btn-block" type="submit" value="Delete" />
                            </form>
                        </div>
                        <div class="col-sm-3 col-xs-6 pull-right nopadding">
                            <form action="updateMessageForm.php" method="post" >
                                <input type="hidden" name="msg_id" value="<?php echo $message['msg_id']; ?>" />
                                <input class=" btn btn-info btn-block" type="submit" value="Edit" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="row">
            <h1>Message Board</h1>
        </div>
        <hr/>
        <?php foreach ($greetings as $greeting) : ?>
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <h2><?php echo $greeting['subject']; ?></h2>
                    <?php echo $greeting['content']; ?>
                </div>
                <div class="col-md-4 col-sm-5 text-right">
                    <span class="text-primary"><?php echo $greeting['event_name']; ?></span><br/>
                    <small><?php echo $greeting['post_date']; ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </main>

<?php require_once "footer.php" ?>