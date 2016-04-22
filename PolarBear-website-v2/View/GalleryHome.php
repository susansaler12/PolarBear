
<div class="col-md-10">

<?php
//include ('../view/header.php');
//require_once ('../Model/productsDB.php');
//require_once ('../Model/ProductsClass.php');
//require_once ('../Model/database.php');
//include ('index1.php');

include ('../Controller/productController.php');


$ProductList = productsDB::getProductList();


foreach($ProductList as $product) {
                    echo "<h4>" . $product['name']. "</h4>";  ?>
                    <form action="wishlist.php" method="post">
                        <input type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id"/>
<!--                        <input type="hidden" value="--><?php //echo $_SESSION['user_id']; ?><!--" name="user_id"/>-->
                        <input type="hidden" value="<?php $product['name'];?>" name="name"/>
                        <input type="submit" value="Add to Wishlist" class="btn"/>
                    </form>
               <?php "<p>" . $product['price'] . "</p>"; }
?>
</div>
</main>