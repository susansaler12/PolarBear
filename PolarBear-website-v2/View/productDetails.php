<?php
session_start();
$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$productID = isset($_GET['productID']) ? $_GET['productID'] : null;
if($productID === null){
    header("Location:../Controller/productController.php");
    exit();
}

require_once '../Model/productsDB.php';
$product = productsDB::getProduct($productID);
if($product === false){
    header("Location:../Controller/productController.php");
    exit();
}

require_once '../Model/GordFeatures.php';

require_once '../View/header.php';
require_once '../View/productsSidebar.php';

?>

<div class="row col-md-10 col-sm-10 col-xs-12">
    <h2>Product Details: <?php echo $product->getName()?></h2>
    <img src="<?php echo $product->getImagePath()?>" alt="Product image: <?php echo $product->getName()?>"/>
    <dl>
        <dt>Product Name</dt>
        <dd><?php echo $product->getName()?></dd>
        <dt>Product Category</dt>
        <dd><?php echo $product->getCategory()?></dd>
        <dt>Product Description</dt>
        <dd><?php echo $product->getDescription()?></dd>
        <dt>Product Price</dt>
        <dd>$<?php echo $product->getPrice()?></dd>
    </dl>
    <h2>Product Reviews</h2>
    <?php
    if($userID !== null){
        if(GordFeatures::checkHasReviewed($userID, $productID) === false){
            echo "You have not submit a review. Click <a href='../View/postReviewForm.php?productID=". $productID ."'>here</a> to review this product.";
        }
    }
    echo GordFeatures::printReviews($productID);
    ?>
</div>
