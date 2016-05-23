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
                            <p><?php echo $product->getCategory()?></p>
                            <p><?php echo $product->getDescription()?></p>
                        </div>

                        <div class="row">
                            <div class='col-md-10 col-md-offset-1'>
                                <form action="../Controller/addProductReview.php" method="post">
                                    <h2>Post Product Review:</h2>
                                    <div class="form-group">
                                        <input type="hidden" name="productID" value="<?php echo $productID?>"/>
                                        <label for="reviewSelect">Rating:</label>
                                        <select id="reviewSelect" name="reviewSelect" class="form-control">
                                            <option value="">Choose a rating</option>
                                            <?php for($i = 0; $i < 6; $i++):?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewText">Comments:</label>
                                        <textarea id="reviewText" name="reviewText" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="reviewSubmit" name="reviewSubmit" value="Submit Review" class="btn btn-info btn-block"/>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once '../View/footer.php';