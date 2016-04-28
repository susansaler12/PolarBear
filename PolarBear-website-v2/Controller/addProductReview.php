<?php
session_start();
$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$reviewSubmit = isset($_POST['reviewSubmit']) ? $_POST['reviewSubmit'] : null;
$productID = isset($_POST['productID']) ? $_POST['productID'] : null;
$rating = isset($_POST['reviewSelect']) ? $_POST['reviewSelect'] : null;
$reviewText = isset($_POST['reviewText']) ? $_POST['reviewText'] : null;

if($userID === null or $reviewSubmit === null){

    header('Location: ../Controller/productController.php');
    exit();
}

if($rating === ''){

    header('Location: ../View/postReviewForm.php');
    exit();
}

require_once '../Model/productsDB.php';
$product = productsDB::getProduct($productID);
if($product === false){

    header("Location:../Controller/productController.php");
    exit();
}

require_once '../Model/GordFeatures.php';
if(GordFeatures::checkHasReviewed($userID, $productID) === true){

    header("Location:../Controller/productController.php");
    exit();
}

require_once '../Model/GordFeatures.php';
if(GordFeatures::postReview($userID, $productID, $rating, $reviewText) === true){
    header("Location:../View/productDetails.php?productID=". $productID);
    exit();
}else{
    echo "ZOMG I BROKE!";
}
