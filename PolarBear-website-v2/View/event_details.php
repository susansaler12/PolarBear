<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
include('../Model/DB_connection.php');
include('../Model/events_DB.php');

$isUpdate = false;
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
}
else{
    require_once "header.php";
    $head1 = "Create a new Event";
    $buttonText = "Create Event";
}

?>
<main id="main" class="container-fluid">
    <div class="row">
        <form action="../Controller/update_event.php<?php if($isUpdate){echo '?event_id=' . $event_id;}?>" method="post" name="event_details_form" id="event_details_form" class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">
            <h1 style="margin-bottom:25px;"><?php echo $head1 ?></h1>
            <div class="form-group">
                <label for="event_name" >Event Name: </label>
                <input type="text" name="event_name" class="form-control input-lg" value="<?php echo $results->event_name?>"/>
            </div>
            <div class="form-group">
                <label for="event_descrip" >Event Description: </label>
                <input type="text" name="event_descrip" class="form-control input-lg" value="<?php echo $results->event_descrip?>"/>
            </div>
            <div class="form-group">
                <label for="event_date">Date: </label>
                <input type="text" name="event_date" id="event_date" class="form-control input-lg" value="<?php
                if(isset($_GET['event_id'])){echo $results->event_date; }
                elseif(isset($_GET['new_date'])){echo $_GET['new_date'];}
                else {echo 'YYYYMMDD';}?>"
                /><span id="date_format"> Date Format: YYYYMMDD</span>
            </div>
            <div class="form-group">
                <label for="event_location">Location: </label>
                <input type="text" name="event_location" class="form-control input-lg" value="<?php echo $results->event_location; ?>"/>
            </div>
            <div class="form-group">
                <label for="guest_of_honor">Guest of Honor: </label>
                <input type="text" name="guest_of_honor" class="form-control input-lg" value="<?php echo $results->guest_of_honor;?>"/>
            </div>
            <p id="surprise-descrip">If this event is for a special someone, or is a surprise event, please let your guests know!</p>
            <div class="form-group">
                <label for="surprise_for">Surprise Party?</label>
                <input type="checkbox" id="form-checkbox" name="surprise_for" <?php if($results->surprise_for){echo "checked='true'";}?>"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info btn-block" id="btnSubmit" name="finished_form" <?php echo "value='$buttonText'"?> />
            </div>
            <hr/>
        </form>
        <hr/><br/>
        <div class="col-xs-2 col-xs-offset-2">
            <a href="calendar_view.php">Back to Calendar</a>
        </div>
    </div>
</main>
<?php require_once "footer.php"?>