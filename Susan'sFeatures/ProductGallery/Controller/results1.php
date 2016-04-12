<?php
 //require_once "productsDB.php";

//@todo BAND VALUE*

$searchParam = isset($_POST['search']) ?  $_POST['search'] :  '';//?????
//$searchParam = "watch";

$search_sql="SELECT * FROM products WHERE Keywords LIKE '%".$searchParam."%' || brand LIKE '%".$searchParam."%' ||name LIKE '%".$searchParam."%'";
//$search_sql="SELECT * FROM products WHERE name LIKE '%".$searchParam."%' OR brand LIKE '%".$searchParam."%'";
$result=$db->query($search_sql);

$p = $result->fetchAll();

//echo '<pre>';
//var_dump($p);

?>

<form action="results.php" method="post" name="results form">
<?php

   if (count($p)>0){
       foreach($p as $searchresults){

           echo "<a href='results.php?id=" . $searchresults['id'] . "'>". $searchresults['name'] . "</a>";

       }
   }
   else{
       echo "No results found";
   }
   ?>





<?php
//<img src = 'images/aaa/$searchresults[\'id\']' alt = $searchresults['id']
//QUESTION:
/*
 * creating a keywords in database, can i have multiple words?
 * displaying search results and linking them to the search terms
 *Can I have 2 select statements? Using the Join!!!!
 * *
 *
 *@todo google bindvalue php like
 * "",""/tags for wordpress.
 */
?>
</form>


