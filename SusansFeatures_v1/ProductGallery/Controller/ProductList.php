<?php ?>

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
            <a href="GalleryHome.php">Browse All</a>
        </div>
        <div>

            <h3>Search by Brand</h3>
            <ul class="side-nav">
                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="index1.php?brand=<?php echo $brand['brand']; ?>">
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
                        <a href="index1.php?category=<?php echo $category['category']; ?>">
                            <?php echo $category['category']; ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            </ul>

        </div>
    </div>
            </div>

    <div id="content" class="row col-md-10 col-sm-10 col-xs-12">
        <div >
                <?php
                $_SESSION['user_id'] = 2;

                foreach($productBrand as $brand) {
                    echo  "<a href='?id='" . $brand->getProduct_ID() .  "><h4>" . $brand->getName() . "</h4></a>";
                ?>
                    <img src="<?php $brand->getImage() ?>"/>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
                      <input type="hidden" value="--><?php //echo $_SESSION['user_id']; ?><!--" name="user_id"/>
                        <input type="hidden" value="<?php $brand->getName();?>" name="name"/>

                        <input type="submit" value="Add to Wishlist" class="btn"/>
                    </form>
                <?php  echo "<p>" . $brand->getPrice() . "</p>"; }?>
        </div>

            <div>

                <?php foreach($productCat as $category) {
                    echo "<h4>" . $category->getName() . "</h4>";
                    ?>
                    <img src="<?php $category->getImage()?>" class="productimg"/>
                  <?php
                    echo $category->getDescription();
                    echo $category->getBrand();
                    ?>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $category->getProduct_ID(); ?>" name="product_id"/>
<!--                        <input type="hidden" value="--><?php //echo $_SESSION['user_id']; ?><!--" name="user_id"/>-->
                        <input type="hidden" value="<?php $category->getName();?>" name="name"/>

                        <input type="submit" value="Add to Wishlist" class="btn"/>
                    </form>


               <?php echo "<p>" . $category->getPrice() . "</p>";}?>

            </div>

      </div>


