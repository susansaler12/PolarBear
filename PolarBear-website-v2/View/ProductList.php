<?php
?>

<!DOCTYPE html>
<html>
<main>

        <h1>Product List</h1>

        <div id="sidebar">
            <!-- display a list of categories -->

    <div class="row col-md-2 col-sm-2 col-xs-12">

        <div>
            <form>
            <p>Search</p>
            <!--<form name="form1" method="post" action="results1.php">
                <input name="search" type="text" />
                <input type="submit" name="Submit" value="Search" placeholder="Search..."/>
            </form>-->
        </div>
        <div>
            <a href="../View/GalleryHome.php">Browse All</a>
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
            </div>

    <div id="content" class="row col-md-10 col-sm-10 col-xs-12">
        <div>
                <?php foreach($productBrand as $brand):?>
                    <a href='?id=<?php echo $brand->getProduct_ID()?>'><h4><?php echo $brand->getName()?></h4></a>
                    <img src="<?php echo $brand->getImagePath() ?>" class="productimg"/>
                    <form action="../View/wishlist.php" method="POST">
                        <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn"/>
                    </form>
                    <p><?php echo $brand->getPrice()?></p>
                    <span><?php echo GordFeatures::getAvgRating($brand->getProduct_ID());?></span>
                <?php endforeach?>
        </div>

            <div>

                <?php foreach($productCat as $category) {
                    echo "<h4>" . $category->getName() . "</h4>";
                    ?>
                    <img src="<?php echo $category->getImagePath()?>" class="productimg"/>
                  <?php
                    echo $category->getDescription();
                    echo $category->getBrand();
                    ?>
                    <form action="../View/wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
                        <input type="submit" name= "finished" value="Add to Wishlist" class="btn"/>
                    </form>
                    <span><?php echo GordFeatures::getAvgRating($brand->getProduct_ID());?></span>
               <?php echo "<p>" . $category->getPrice() . "</p>";}?>

            </div>

      </div>


