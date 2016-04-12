<!-- DUE TO A BUG WITH PHP STORM, AFTER FINISHING TO SUBMIT THIS PROJECT, I WAS UNABLE TO REFACTOR THE PROJECT INTO APPROPRIATELY NAMED DIRECTORIES. THE CODE REFACTORING TOOL IS NOT WORKING PROPERLY -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create and Update Events</title>
    <link rel="stylesheet" type="text/css" href="../styles/eventStyle.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<!--Some of this will need to be edited for a logged in user -->
    <h1>List of all Events for User</h1>
    <?php
include('../Models/DB_connection.php');
include('../Models/events_DB.php');
$tOutput = "<table id='main-display'><thead><th>Event ID</th><th>Description</th><th>Date</th><th>Location</th><th>Event Creator</th><th>Guest of Honor</th><th>Surprise For</th><th>Action</th></thead>";
$allEvents = events::getEventsForUser('GordSChnurr@gmail.com');
foreach($allEvents as $row){
    $tOutput .= "<tr>";
    foreach($row as $key => $column){
        if(is_int($key)){
            if($column != null){
                $tOutput .=  "<td>$column</td>";
            }
            else{
                $tOutput .= "<td>null</td>";
            }
        }
    }
    $tOutput .= "<td><a href='event_details.php?event_id=$row[0]'>EDIT</a> | <a id='delete_row' href='../process_pages/delete_event.php?event_id=$row[0]'>DELETE</a> | <a href='event_invite.php?event_id=$row[0]'>INVITE</a></td></tr>";
}
$tOutput .= "</table>";
echo $tOutput;
?>

<h3><a href="event_details.php" id="create_button">Create a New Event</a></h3>
<?php
if(isset($_GET['message'])){
    echo "<h2>" . $_GET['message'] . "</h2>";
}
?>
</body>
</html>