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
<main id="main" class="container-fluid">
    <div class="col-xs-10 col-md-8 col-lg-6 col-xs-offset-1 col-md-offset-2 col-lg-offset-3">
        <h1 id="event_details_name"><?php echo $results->event_name ?></h1>
        <p style="color:red;"><?php
            if(isset($_GET['message'])){
                echo $_GET['message'];
            }
            elseif(invites::checkConfirmed((int)$id, (int)$event_id)[0] != null){
                echo "<h2>Your Invite is Unconfirmed!</h2> <a href='../Controller/confirm_invite.php?event_id=$event_id'>CONFIRM</a> | <a href='../Controller/decline_invite.php?event_id=$event_id'>DECLINE</a>";
            }
            ?></p>
        <p id="event_details_date"><?php echo $results->event_date ?></p><br/>
        <p id="event_details_location"><?php echo $results->event_location ?></p>
        <p id="event_details_descrip"><?php echo $results->event_descrip ?></p>
        <p id="event_details_goh"><?php echo $results->guest_of_honor ?></p>
        <?php if($results->surprise_for == 1){echo "<p>THIS IS A SURPRISE EVENT!</p>";}?>
        <span><a href="calendar_view.php">View Calendar</a><?php if($isRows){
                echo " | <a href='event_details.php?event_id=" . $event_id ."'>Edit Event Details</a>";
            }?></span><br/><br/>
            <div class="row">
                <form action="" method="post" class="col-xs-6">
                    <div>
                        <p>Find Guests to Invite</p>
                        <input type="search" class="form-control input-lg" name="search" value="<?php if($searchText !== null){ echo $searchText;}  ?>"/>
                        <input type="submit" value="Search" class="btn btn-info"/>
                    </div>
                </form>
            </div>
            <div class="row">
            <?php if($searchText !== null) {
                $searchResult = GordFeatures::searchProfiles($searchText);
                if(count($searchResult) === 0){ echo "No results Found";}
                else{
                    foreach($searchResult as $r){
                        echo "<hr/><br/><p>$r->full_name</p>";
                        echo "<form action='../Controller/add_invite.php?event_id=" . $event_id . "' method='post' name='invite_form' id='invite_form'>
                              <input type='hidden' name='invitee' value='$r->id'/><br/>
                              <label for='invite_priv'>Allow Guest to Add Invites?</label>
                              <input type='checkbox' name='invite_priv'/><br/>
                              <input type='submit' class='btn btn-info' name='finished_form' value='Invite Guest'/>";
                    }
                    echo "<hr/><br/>";
                }
            }
            ?>
            </div>
    </div>
</main>
<?php
require_once "footer.php";
?>
