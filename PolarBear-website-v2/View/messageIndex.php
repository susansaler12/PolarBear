<?php
session_start();

$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

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

//check if user is admin
/*$isUpdate = false;
if(isset($_GET['event_id']) && $loggedIn == true){
    $rows = events::checkCreator($_GET['event_id'],$_SESSION['id']);
    if($rows[0] == null){
        header("Location:calendar_view.php?message=I'm sorry, you are not authorized to edit this event");
        exit();
    }
    else{
        $results = events::getEvent($_GET['event_id']);
        $queryString = "?event_id=" . $_GET['event_id'];
        require_once "header.php";
        $head1 =  "Edit Event Details";
        $buttonText = "Update Event";
        $event_id = $_GET['event_id'];
        $isUpdate = true;
    }
}*/


//var_dump($messages);
require_once 'header.php';

?>


    <main id="main" class="container-fluid messageBoard">
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
                <div class="col-sm-8">
                    <h2><?php echo $message['subject']; ?></h2>
                    <?php echo $message['content']; ?>
                </div>
                <div class="col-sm-4 text-right">
                    <span class="text-primary"><?php echo $message['event_name']; ?></span><br/>
                    <small><?php echo $message['post_date']; ?></small>
                    <div class="row">
                        <div class="col-sm-4 pull-right">
                            <div class="row">
                                <!-- Edit button starts here -->
                                <div class="col-sm-6 nopadding">
                                    <form action="updateMessageForm.php" method="post" >
                                        <input type="hidden" name="msg_id" value="<?php echo $message['msg_id']; ?>" />
                                        <input class=" btn btn-info" type="submit" value="Edit" />
                                    </form>
                                </div>
                                <div class="col-sm-6 nopadding">
                                    <form action="../Controller/deleteMessage.php" method="post" onsubmit="return confirm('Are you sure you want to delete this message?');" >
                                        <input type="hidden" name="msg_id" value="<?php echo $message['msg_id']; ?>" />
                                        <input class="btn btn-default" type="submit" value="Delete" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
<?php require_once "footer.php" ?>