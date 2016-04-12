<!DOCTYPE html>
<html>
<main>

        <h1>Product List</h1>

        <div id="sidebar">
            <!-- display a list of categories -->

    <div class="row col-md-2 col-sm-2 col-xs-12">

        <div>

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



<?php
foreach($productList as $product) {
    echo $product->getName() . " " . '<br />' . $product->getPrice();
    echo $product->getDescription();
    echo $product->getBrand();
}
?>


        <div id="content" class="row col-md-10 col-sm-10 col-xs-12">
            <!-- display a table of products -->
            <div id="show"
                <?php
                foreach($productList as $product){
                    echo $product->getName() . " " . '<br />' . $product->getPrice();
                    echo $product->getDescription();
                    echo $product->getBrand();

                    ?>
                    <form action="." method="post">
                        <input type="submit" value="Add to Wishlist" />
                    </form>
                <?php }?>
            </div>
        <div>
                <?php foreach($productBrand as $brand) {
                    echo $brand->getName() . " " . '<br />' . $brand->getPrice();
                    echo $brand->getDescription();
                    echo $brand->getBrand();
                ?>
                    <form action="." method="post">
                        <input type="submit" value="Add to Wishlist" />
                    </form>
                <?php }?>
        </div>

            <div>
                <?php foreach($productCat as $category) {
                    echo $category->getName() . " " . '<br />' . $category->getPrice();
                    echo $category->getDescription();
                    echo $category->getBrand();
                    ?>

                <form action="." method="post">
                       <p><a href="wishlist.php" class="btn">Add to Wishlist</a></p>
                        <input type="submit" value="Add to Wishlist" />
                  </form>
                <?php }?>
            </div>
        </div>
<!--                        <form action="." method="post"-->
<!--                                  id="delete_product_form">-->
<!--                                <input type="hidden" name="action"-->
<!--                                       value="delete_product" />-->
<!--                                <input type="hidden" name="product_id"-->
<!--                                       value="--><?php ///*echo $product->getProduct_ID(); */?><!--" />-->
<!--                                <input type="hidden" name="category_id"-->
<!--                                       value="--><?php ///*echo $product->getProduct_ID(); */?><!--" />-->
<!--                                <input type="submit" value="Add to Cart" /> <!--orginally a delete button-->
<!--                            </form>
<!--                         </p>-->
<!--<!--                --><?php ?>

<!--            <p><a href="?action=show_add_form">Add Product</a></p>
        </div>-->


