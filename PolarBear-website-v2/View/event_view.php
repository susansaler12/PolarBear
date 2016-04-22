<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
$id = $_SESSION['id'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    include('../Model/DB_connection.php');
    include('../Model/invites_DB.php');
    include('../Model/events_DB.php');
    $searchText = isset($_POST['search']) ? trim($_POST['search']) : null;
    $isRows = events::checkCreator($event_id,$id)[0] === null ? false : true;
    $results = events::getEvent($_GET['event_id']);
}
else{
    header('Location:event_details.php');
    exit();
}
require_once "header.php";
require_once "../Model/GordFeatures.php";
?>
<h1 id="event_details_name"><?php echo $results->event_name ?></h1>
<h2 style="color:red;"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></h2>
<p id="event_details_date"><?php echo $results->event_date ?></p>
<p id="event_details_location"><?php echo $results->event_location ?></p>
<p id="event_details_descrip"><?php echo $results->event_descrip ?></p>
<p id="event_details_goh"><?php echo $results->guest_of_honor ?></p>
<?php if($results->surprise_for == 1){echo "<p>THIS IS A SURPRISE EVENT!</p>";}?>
<span><a href="calendar_view.php">View Calendar</a><?php if($isRows){
        echo " | <a href='event_details.php?event_id=" . $event_id ."'>Edit Event Details</a>";
    }?></span><br/><br/>
    <form action="" method="post">
        <p>Find Guests to Invite</p>
        <input type="search" name="search" value="<?php if($searchText !== null){ echo $searchText;}  ?>"/>
        <input type="submit" value="Search"/>
    </form>
    <?php if($searchText !== null) {
        $searchResult = GordFeatures::searchProfiles($searchText);
        if(count($searchResult) === 0){ echo "No results Found";}
        else{
            foreach($searchResult as $r){
                echo "<p>$r->full_name</p>";
                echo "<form action='../Controller/add_invite.php?event_id=" . $event_id . "' method='post' name='invite_form' id='invite_form'>
                      <input type='hidden' name='invitee' value='$r->id'/><br/>
                      <label for='invite_priv'>Allow Guest to Add Invites?</label>
                      <input type='checkbox' name='invite_priv'/>
                      <input type='submit' name='finished_form' value='Invite Guest'/>";
                //echo "<p>$r->full_name</p> | <a href=''>Invite as Guest</a> | <a href=''>Invite as Host</a>";
            }
        }
    }
    ?>
<h2>Invite Guests</h2>
<?php
require_once "footer.php";
?>
