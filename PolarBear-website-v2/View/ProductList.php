<?php
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

            <!------------------------- GALLERY ---------------------------->
            <div id="gallery" class="row">
            <?php
                if(isset($_GET['category'])){
                    foreach($productCat as $category){
            ?>
                        <div class='thumbnails col-md-3 col-sm-4 col-xs-12'>
                            <div class="productimg">
                                <img src="<?php echo$category->getImagePath()?>" />
                            </div>
                            <?php
                                echo "<h1><a href='../View/productDetails.php?productID=". $category->getProduct_ID() ."'>" . $category->getName() . "</a></h1>";
                                echo "<h3 class='pull-left'>$" . $category->getPrice() . "</h3>";
                            ?>
                            <span class="pull-right">Avg. Rating: <?php echo GordFeatures::getAvgRating($category->getProduct_ID());?></span>
                            <form action="../Controller/wishlist.php" method="post">
                                <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
                                <!--<input type="hidden" value="<?php //echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                                <input type="hidden" value="<?php echo $category->getName();?>" name="name"/>
                                <input type="submit" name= "finished" value="Add to Wishlist" class="btn btn-info btn-block"/>
                            </form>
                        </div>
            <?php
                    }
                } else if(isset($_GET['brand'])) {
                    foreach($productBrand as $brand){
            ?>
                        <div class='thumbnails col-md-3 col-sm-4 col-xs-12'>
                            <div class="productimg">
                                <img src="<?php echo$brand->getImagePath()?>" />
                            </div>
                            <?php
                                echo "<h1><a href='../View/productDetails.php?productID=". $brand->getProduct_ID() ."'>". $brand->getName() . "</a></h1>";
                                echo "<h3 class='pull-left'>$" . $brand->getPrice() . "</h3>";
                            ?>
                            <span class="pull-right">Avg. Rating: <?php echo GordFeatures::getAvgRating($brand->getProduct_ID());?></span>
                            <form action="../Controller/wishlist.php" method="post">
                                <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                                <input type="hidden" value="<?php echo $brand->getName();?>" name="name"/>
                                <input type="submit" name= "finished" value="Add to Wishlist" class="btn btn-info btn-block"/>
                            </form>
                        </div>
            <?php
                    }
                } else {
                    foreach($ProductList as $product) {
            ?>
                        <div class='thumbnails col-md-3 col-sm-4 col-xs-12'>
                            <div class="productimg">
                                <img src="<?php echo$product->getImagePath()?>" />
                            </div>
                            <?php
                                echo "<h1><a href='../View/productDetails.php?productID=". $product->getProduct_ID() ."'>" . $product->getName() . "</a></h1>";
                                echo "<h3 class='pull-left'>$" . $product->getPrice() . "</h3>";
                            ?>
                            <span class="pull-right">Avg. Rating: <?php echo GordFeatures::getAvgRating($product->getProduct_ID());?></span>
                            <form action="../Controller/wishlist.php" method="post">
                                <input type="hidden" value="<?php echo $product->getProduct_ID(); ?>" name="product_id"/>
                                <!--<input type="hidden" value="--><?php /*//echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                                <input type="hidden" value="<?php echo $product->getName();?>" name="name"/>
                                <input type="submit" name= "finished" value="Add to Wishlist" class="btn btn-info btn-block"/>
                            </form>
                        </div>
            <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>
</main>

