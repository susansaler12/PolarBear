<?php
session_start();
$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$productID = isset($_GET['productID']) ? $_GET['productID'] : null;
if($productID === null or $userID === null){
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

    <div class="col-md-6">
        <img src="<?php echo $product->getImagePath()?>" alt="Product image: <?php echo $product->getName()?>"/>
    </div>

    <div class="col-md-6">
        <h2><?php echo $product->getName()?></h2>
        <p> <?php echo $product->getCategory()?></p>
        <P> $<?php echo $product->getPrice()?></P>
        <p><?php echo $product->getDescription()?></p>

        <form action="../Controller/addProductReview.php" method="post" class="col-md-6">
            <h2>Post Product Review:</h2>
            <div class="form-group">
                <input type="hidden" name="productID" value="<?php echo $productID?>"/>
                <label for="reviewSelect">Rating:</label>
                <select id="reviewSelect" name="reviewSelect" class="form-control input-lg">
                    <option value="">Choose a rating</option>
                    <?php for($i = 0; $i < 6; $i++):?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endfor ?>
                </select>
            </div>
            <div class="form-group">
                <label for="reviewText">Comments:</label>
                <textarea id="reviewText" name="reviewText" class="form-control input-lg"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" id="reviewSubmit" name="reviewSubmit" value="Submit Review" class="btn btn-info btn-block"/>
            </div>
        </form>
    </div>
<?php require_once 'footer.php'?>