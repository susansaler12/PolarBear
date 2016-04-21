<?php
require_once 'GordFeatures.php';
$searchText = isset($_POST['search']) ? trim($_POST['search']) : null;
?>
    <form action="" method="post">
        <p>Search for a profile.</p>
        <input type="search" name="search" value="<?php if($searchText !== null){ echo $searchText;}  ?>"/>
        <input type="submit" value="Search"/>
    </form>
<?php if($searchText !== null) {
    GordFeatures::printUserSearch($searchText);
} ?>