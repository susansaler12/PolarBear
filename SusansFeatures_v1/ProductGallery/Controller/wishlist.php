<?php


//var_dump($_POST);
require_once  ("../Model/database.php");
require_once ("../Model/wishlistDB.php");
require_once ("../Model/ProductsClass.php");
require_once ("../Model/productsDB.php");



$product_id = $_POST['product_id'];
$user_id = $_POST['user_id'];


//$name = $_POST['name'];

//$names = wishlistDB::getWishlist($name);
//$name = $wishlist::getWishlist();

$wishlist = new wishlistDB();

$wishlistR = $wishlist->AddWishlist($product_id, $user_id);
$product = productsDB::getProduct($product_id);
var_dump($product);


?>

<!DOCTYPE html>
<html>

<main>

</main>
</html>

