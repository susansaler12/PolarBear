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
    <form action="../Controller/addProductReview.php" method="post">
        <div>
            <input type="hidden" name="productID" value="<?php echo $productID?>"/>
            <label for="reviewSelect">Rating:</label>
            <select id="reviewSelect" name="reviewSelect">
                <option value="">Choose a rating</option>
                <?php for($i = 0; $i < 6; $i++):?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
        </div>
        <div>
            <label for="reviewText">Comments:</label>
            <textarea id="reviewText" name="reviewText"></textarea>
        </div>
        <input type="submit" id="reviewSubmit" name="reviewSubmit" value="Submit Review"/>
    </form>
</div>
<?php require_once 'footer.php'?>