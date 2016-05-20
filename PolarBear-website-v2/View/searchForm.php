<?php
require_once '../Model/GordFeatures.php';
$searchText = isset($_POST['search']) ? trim($_POST['search']) : null;
?>
    <form action="" method="post">
        <h2>Search for a profile</h2>
        <div class="form-group">
            <div class="searchInputBox">
                <input type="search" class="form-control input-lg" name="search" value="<?php if($searchText !== null){ echo $searchText;}  ?>"/>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Search"/>
        </div>
    </form>

    <div class="searchResultBox">
        <?php if($searchText !== null) {
            echo GordFeatures::printUserSearch($searchText);
        } ?>
    </div>