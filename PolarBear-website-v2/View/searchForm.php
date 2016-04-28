<?php
require_once '../Model/GordFeatures.php';
$searchText = isset($_POST['search']) ? trim($_POST['search']) : null;
?>
    <form action="" method="post" class="columnBox">
        <h2>Search for a profile</h2>
        <div class="form-group">
            <input type="search" class="form-control input-lg" name="search" value="<?php if($searchText !== null){ echo $searchText;}  ?>"/>
            <input type="submit" class="btn btn-info btn-block" value="Search"/>
        </div>
    </form>
<?php if($searchText !== null) {
    echo GordFeatures::printUserSearch($searchText);
} ?>