 <form action="" method="post">
     <p>Search for a profile.</p>
     <input type="search" name="search" value="<?php echo $searchText?>"/>
     <input type="submit" value="Search"/>
 </form>
 <?php if($searchText !== null) {
     GordFeatures::printUserSearch($searchText);
 } ?>
