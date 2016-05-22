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

<div class="container row col-md-10 col-sm-10 col-xs-12">
    <div class="col-md-6">
        <img src="<?php echo $product->getImagePath()?>" alt="Product image: <?php echo $product->getName()?>"/>
    </div>


    <div class="col-md-6">
        <h2><?php echo $product->getName()?></h2>
        <form action="../Controller/wishlist.php" method="post">
            <input type="hidden" value="<?php /*echo $product->getProduct_ID(); */?>" name="product_id"/>
            <!--<input type="hidden" value="--><?php /*//echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
            <input type="hidden" value="<?php /*$product['name'];*/?>" name="name"/>
            <input type="submit" name= "finished" value="Add to Wishlist" class="btn" id="wbtn"/>
        </form>
        <p> <?php echo $product->getCategory()?></p>
        <P> $<?php echo $product->getPrice()?></P>
        <p><?php echo $product->getDescription()?></p>
        <h2 id="review">Product Reviews</h2>
        <?php
        if($userID !== null){
            if(GordFeatures::checkHasReviewed($userID, $productID) === false){
                echo "You have not submit a review. Click <a href='../View/postReviewForm.php?productID=". $productID ."'>here</a> to review this product.";
            }
        }
        echo GordFeatures::printReviews($productID);
        ?>
    </div>
</div>
<?php require_once '../View/footer.php';