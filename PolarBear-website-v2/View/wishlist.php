<?php
session_start();
$loggedIn = $_SESSION['loggedIn'];
if($loggedIn !== true){
    header("Location:login.php");
    exit();
}

//var_dump($_POST);
require_once  ("../Model/DB_connection.php");
require_once ("../Model/wishlistDB.php");
require_once ("../Model/ProductsClass.php");
require_once ("../Model/productsDB.php");


$product_id = $_POST['product_id'];
$user_id = $_SESSION['id'];

//$name = $_POST['name'];

//$names = wishlistDB::getWishlist($name);
//$name = $wishlist::getWishlist();

$wishlistR = wishlistDB::AddWishlist($product_id, $user_id);
$product = productsDB::getProduct($product_id);

header("Location:../View/showprofile.php");
?>

