<?php
require_once '../View/header.php';
?>
<main>

    <?php require_once '../View/productsSidebar.php' ?>

    <div class="container-fluid">
        <div id="content" class="row col-md-10 col-sm-10 col-xs-12">
            <div id="Gallery">
                <?php
                if(isset($_GET['category']))
                {
                foreach($productCat as $category)
                {?>
                <div class='blockimg123'>
                    <img src="<?php echo$category->getImagePath()?>" class="productimg" />
                    <?php
                    echo "<h4><a href='../View/productDetails.php?productID=". $category->getProduct_ID() ."'>" . $category->getName() . "</a></h4>"; ?>

                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
                        <!--<input type="hidden" value="<?php //echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                        <input type="hidden" value="<?php /*$category->getName();*/?>" name="name"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn  pull-right"/>
                    </form>
                    <span><?php echo GordFeatures::getAvgRating($category->getProduct_ID());?></span>
                    <?php echo "<p>$" . $category->getPrice() . "</p></div>";
                    }
                    }

                    else if(isset($_GET['brand']))
                    {
                    foreach($productBrand as $brand)
                    {?>
                    <div class='blockimg123'>
                        <img src="<?php echo$brand->getImagePath()?>" class="productimg" />
                        <?php
                        echo "<h4><a href='../View/productDetails.php?productID=". $brand->getProduct_ID() ."'>". $brand->getName() . "</a></h4>";?>

                        <form action="wishlist.php" method="post">
                            <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                            <input type="submit" name= "finished" value="Add to Wishlist" class="btn  pull-right"/>
                        </form>
                        <span><?php echo GordFeatures::getAvgRating($brand->getProduct_ID());?></span>
                        <?php
                        echo "<p>$" . $brand->getPrice() . "</p></div>";
                        }
                        }
                        else
                        {foreach($ProductList as $product)
                        {?>
                        <div class='blockimg123'>
                            <img src="<?php echo$product->getImagePath()?>" class="productimg" />
                            <?php
                            echo "<h4><a href='../View/productDetails.php?productID=". $product->getProduct_ID() ."'>" . $product->getName() . "</a></h4>";?>
                            <form action="wishlist.php" method="post">
                                <input type="hidden" value="<?php /*echo $product->getProduct_ID(); */?>" name="product_id"/>
                                <!--<input type="hidden" value="--><?php /*//echo $_SESSION['user_id']; */?><!--" name="user_id"/>-->
                                <input type="hidden" value="<?php /*$product['name'];*/?>" name="name"/>
                                <input type="submit" name= "finished" value="Add to Wishlist" class="btn  pull-right"/>
                            </form>
                            <span><?php echo GordFeatures::getAvgRating($product->getProduct_ID());?></span>
                            <?php echo "<p>$" . $product->getPrice() . "</p></div>";
                            }
                            } ?>

                        </div>
                    </div>
</main>
</html>

