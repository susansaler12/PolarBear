<?php
require ("productsDB.php");


$search_sql="SELECT * FROM products WHERE product_id=" . $_GET['product_id'];
//var_dump($search_sql);exit();
//$search_sql="SELECT * FROM products WHERE name LIKE '%".$searchParam."%' OR brand LIKE '%".$searchParam."%'";
$result=$db->query($search_sql);

$p=$result->fetchAll();

?>



<p>Search</p>
<form name="form2" method="post" action="">



   <?php

   if (count($p)>0){
       foreach($p as $searchresults){

           echo "<p>" . $searchresults['name'] . $searchresults['brand'] . $searchresults['location']. "</p>";
           echo "<img src=" . $searchresults['Image'] . "/>";
          /* echo "<p>" . $searchresults['name'] .  $searchresults['Image'] . "</p>";*/
       }
   }
   else{
       echo "No results found";
   }
   ?>


</form>
