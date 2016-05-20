<?php
require_once "../Controller/session_start.php";
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}
$id = $_SESSION['id'];
//this is my page for showing 1 profile of a specific user
require_once "../Model/DB_connection.php";


$sql ="SELECT * FROM user_profiles WHERE id = '$id'"; //you dont have to name is query you can name it anything
$db = DB_connection::getDB();
$result = $db->query($sql);

require_once "header.php";
require_once "../Model/GordFeatures.php";

?>

    <main id="main" class="container showprofile">
        <div class="row profileWrapper">
            <!--User profile-->
            <div class="col-md-4">
                <div class="columnBox text-center">
                    <div class="profile">
                        <?php foreach($result as $p): ?>
                            <h2><?php echo $p['fname'] . " " . $p['lname'] ?> Profile</h2>
                            <br/>
                            <div>Interests: <?php echo $p['interests'] ?></div>
                            <div>Image: <?php echo $p['image'] ?></div>
                        <?php endforeach ?>
                    </div>
                </div>

                <?php $fupdate = "<form action ='updateprofileform.php' method='post'>" .
                    "<input type='hidden' name='id' value='" . $p['id'] . "' />".
                    "<input type='submit' class='btn btn-info btn-block' name='uprofile' value='UPDATE'/>".
                    "</form>";
                echo $fupdate; ?>
            </div>

            <!--Wishlist-->
            <div class="col-md-4">
                <div class="columnBox">
                    <?php
                    echo GordFeatures::printWishlist($id);
                    //This will print the current user's id
                    //If you need to do this for other people's profiles this will require other logic
                    ?>
                </div>
                <a href="calendar_view.php" class='btn btn-info btn-block'>View Events</a>
            </div>


            <!--search bar-->
            <div class="col-md-4">
                <div class="searchFormBox">
                    <?php require_once 'searchForm.php'; ?>
                </div>
            </div>

            <div class="row viewFriend">
                <a href="listfriendrequest.php" class='btn btn-info'>View Friend Requests</a>
            </div>

               <!-- " : " . $p['location'] . " : " . $p['birthday'] .
                " : " . $p['interests'] . "</div>";
            $fupdate = "<form action ='updateprofileform.php' method='post'>" .
                "<input type='hidden' name='id' value='" . $p['id'] . "' />".
                "<input type='submit' name='uprofile' value='UPDATE'/>".
                "</form>";
            echo $fupdate . "<div>";
            $fdelete = "<form action ='deleteprofile.php' method='post'>" .
                "<input type='hidden' name='id' value='" . $p['id'] . "' />".
                "<input type='submit' name='dprofile' value='DELETE'/>".
                "</form>";
            echo $fdelete . "<div>";-->
        </div>
    </main>
<?php require_once "footer.php"; ?>