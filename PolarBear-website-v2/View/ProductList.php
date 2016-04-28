<!DOCTYPE html>
<html>
<main>
<<<<<<< HEAD
    <?php require_once '../View/productsSidebar.php' ?>
=======


    <div class="row col-md-2 col-sm-2 col-xs-12">
        <div>
            <form>
                <p>Search</p>
                <form name="form1" method="post" action="results1.php">
                    <input name="search" type="text" />
                    <input type="submit" name="Submit" value="Search" placeholder="Search..."/>
                </form>
        </div>
        <div>
            <a href="?GalleryHome.php">Browse All</a>
        </div>
        <div>

            <h3>Search by Brand</h3>
            <ul class="side-nav">
                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="../Controller/productController.php?brand=<?php echo $brand['brand']; ?>">
                            <?php echo $brand['brand']; ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <h3>Search by Category</h3>
            <ul class="side-nav">
                <?php foreach ($categories as $category) : ?>
                    <li>
                        <a href="../Controller/productController.php?category=<?php echo $category['category']; ?>">
                            <?php echo $category['category']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
>>>>>>> 4ba10785710beaa090b46e21d9eecf1a02ab5cb7
    <div id="content" class="row col-md-10 col-sm-10 col-xs-12">
        <div id="Gallery">
            <?php
            if(isset($_GET['category']))
            {
                foreach($productCat as $category)
                {
                    echo "<h4><a href='../View/productDetails.php?productID=". $category->getProduct_ID() ."'>" . $category->getName() . "</a></h4>"; ?>
                    <img src="<?php echo$category->getImagePath()?>" class="productimg"/>
                    <?php
                    echo $category->getDescription();
                    echo $category->getBrand();
                    ?>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
                        <!--<input type="hidden" value="<?php //echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                        <input type="hidden" value="<?php /*$category->getName();*/?>" name="name"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn"/>
                    </form>
                    <span><?php echo GordFeatures::getAvgRating($category->getProduct_ID());?></span>
                    <?php echo "<p>" . $category->getPrice() . "</p>";
                }
            }
            else if(isset($_GET['brand']))
            {
                foreach($productBrand as $brand)
                {
                    echo "<h4><a href='../View/productDetails.php?productID=". $brand->getProduct_ID() ."'>". $brand->getName() . "</a></h4>";?>
                    <img src="<?php echo $brand->getImagePath() ?>" class="productimg"/>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn"/>
                    </form>
                    <span><?php echo GordFeatures::getAvgRating($brand->getProduct_ID());?></span>
                    <?php
                    echo "<p>" . $brand->getPrice() . "</p>";
                }
            }
            else
            {
                foreach($ProductList as $product)
                {
                    echo "<h4><a href='../View/productDetails.php?productID=". $product->getProduct_ID() ."'>" . $product->getName() . "</a></h4>";?>                         <img src="<?php echo $product->getImagePath() ?>" class="productimg"/>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php /*echo $product->getProduct_ID(); */?>" name="product_id"/>
                        <!--<input type="hidden" value="--><?php /*//echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                        <input type="hidden" value="<?php /*$product['name'];*/?>" name="name"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn"/>
                    </form>
                    <span><?php echo GordFeatures::getAvgRating($product->getProduct_ID());?></span>
                    <?php echo "<p>" . $product->getPrice() . "</p>";
                }
            } ?>
        </div>
    </div>
</main>
</html>
