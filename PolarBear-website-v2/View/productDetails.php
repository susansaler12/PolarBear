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

?>
    <main id="products" class="container-fluid">
        <!----------------------- SEARCH BAR ---------------------------->
        <div class="row">
            <div id="searchBar">
                <form role="search">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">search<!-- <i class="glyphicon glyphicon-search"></i> --></button>
                            <a class="btn btn-default" href="?GalleryHome.php">Browse All</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <!-------------------- SIDE BAR / LEFT COLUMN ------------------------>
            <aside id="side-nav" class="col-md-2 col-xs-3">
                <?php require_once '../View/productsSidebar.php' ?>
            </aside>

            <!------------------------ RIGHT COLUMN ----------------------------->
            <div class="col-md-10 col-sm-8 col-xs-7">

                <!------------------------- PRODUCT DETAILS ---------------------------->
                <div id="gallery" class="row">
                    <div class="col-md-5 col-sm-6">
                        <div class="productDetailsImg">
                            <img src="<?php echo $product->getImagePath()?>" alt="Product image: <?php echo $product->getName()?>"/>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="details">
                            <h1><?php echo $product->getName()?></h1>
                            <h3>$<?php echo $product->getPrice()?></h3>
                            <p>Category: <?php echo $product->getCategory()?></p>
                            <p>Description: <?php echo $product->getDescription()?></p>
                            <form action="../Controller/wishlist.php" method="post">
                                <input type="hidden" value="<?php /*echo $product->getProduct_ID(); */?>" name="product_id"/>
                                <!--<input type="hidden" value="--><?php /*//echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                                <input type="hidden" value="<?php /*$product['name'];*/?>" name="name"/>
                                <input type="submit" name= "finished" value="Add to Wishlist" class="btn btn-info btn-block" id="wbtn"/>
                            </form>
                        </div>
                        <div class="row">
                            <div class='col-md-11'>
                                <h4 id="review">Product Reviews</h4>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once '../View/footer.php';