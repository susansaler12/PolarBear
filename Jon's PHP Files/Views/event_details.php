<link rel="stylesheet" type="text/css" href="../styles/eventStyle.css"/>
<?php
$queryString = "";

if(isset($_GET['event_id'])){
    include('../Models/DB_connection.php');
    $results = events::getEvent($_GET['event_id']);
    $queryString = "?event_id=" . $_GET['event_id'];
}

if(isset($results)){
    echo "<h1>Edit Event Details</h1>";
    $buttonText = "Update Event";
}
else{
    echo "<h1>Create a new Event</h1>";
    $buttonText = "Create Event";
}

?>
<form action="../process_pages/update_event.php" method="post" name="event_details_form" id="event_details_form">
    <label for="event_name" >Event Name: </label>
    <input type="text" name="event_name" value="<?php echo $results->event_name?>"/><br/>
    <label for="event_descrip" >Event Description: </label>
    <input type="text" name="event_descrip" value="<?php echo $results->event_descrip?>"/><br/>
    <label for="event_date">Date: </label>
    <input type="text" name="event_date" id="event_date" value="<?php
        if(isset($_GET['event_id'])){echo $results->event_date; }
        elseif(isset($_GET['new_date'])){echo $_GET['new_date'];}
        else {echo 'YYYYMMDD';}?>"
    /><span id="date_format"> Date Format: YYYYMMDD</span><br/>
    <label for="event_location">Location: </label>
    <input type="text" name="event_location" value="<?php echo $results->event_location; ?>"/><br/>
    <p id="surprise-descrip">If this event is for a special someone, or is a surprise event, please let your guests know!</p>
    <label for="guest_of_honor">Guest of Honor: </label>
    <input type="text" name="guest_of_honor" value="<?php echo $results->guest_of_honor;?>"/><br/>
    <label for="surprise_for">Surprise Party?</label>
    <input type="checkbox" name="surprise_for" <?php if($results->surprise_for){echo "checked='true'";}?>"/><br/>
    <br/>
    <input type="submit" name="finished_form" <?php echo "value='$buttonText'"?>/>
</form>
<h3><a href="calendar_view.php" id="back_button"> <<< Back to Events</a></h3>
