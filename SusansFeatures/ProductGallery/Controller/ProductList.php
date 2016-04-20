<?php
//need to tell ProductList.php to get $productLists from DB
//require('../Model/productsDB.php');
//$productLists = ProductsDB::getProductList();
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
            <form name="form1" method="post" action="results1.php">
                <input name="search" type="text" />
                <input type="submit" name="Submit" value="Search" placeholder="Search..."/>
            </form>

        </div>
      <div>
          <a href="?product=<?php echo $product;?>">Browse All</a>
      </div>

        <div>
            <h3>Search by Brand</h3>
            <ul class="side-nav">
                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="?brand=<?php echo $brand['brand']; ?>">
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
                        <a href="?category=<?php echo $category['category']; ?>">
                            <?php echo $category['category']; ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>

        <div id="content" class="row col-md-10 col-sm-10 col-xs-12">

        <div>
                <?php
                $_SESSION['user_id'] = 2;

                foreach($productBrand as $brand) {
                    echo $brand->getName() . " " . '<br />' . $brand->getPrice();
                    echo $brand->getDescription();
                    echo $brand->getBrand();

                ?>
                    <img src="<?php $brand->getImage() ?>"/>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id"/>
                        <input type="hidden" value="<?php $brand->getName();?>" name="name"/>
<!--                        -->
                        <input type="submit" value="Add to Wishlist" class="btn"/>
                    </form>
                <?php }?>
        </div>

            <div>
                <?php foreach($productCat as $category) {
                    echo $category->getName() . '<br />' . $category->getPrice();
                    ?>
                    <img src="<?php $category->getImage()?>"/>
                  <?php
                    echo $category->getDescription();
                    echo $category->getBrand();
                    ?>

                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id"/>
                        <input type="hidden" value="<?php $category->getName();?>" name="name"/>
                        <!--                        -->
                        <input type="submit" value="Add to Wishlist" class="btn"/>
                    </form>


               <?php }?>

            </div>
        </div>
            </div>
    </main>
</html>
