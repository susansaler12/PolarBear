<?php
session_start();
$productID = isset($_GET['productID']) ? $_GET['productID'] : null;
if($productID ===null){
    header("Location:../Controller/productController.php");
    exit();
}
require_once '../Model/productsDB.php';

require_once 'header.php';
//require_once 'productSidebar.php';

$product = productsDB::getProduct($productID);