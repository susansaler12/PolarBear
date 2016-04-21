<?php

foreach($productBrand as $brand) {
echo $brand->getName() . " " . '<br />' . $brand->getPrice();
echo $brand->getDescription();
echo $brand->getBrand();
?>
<form action="wishlist.php" method="post">
    <input type="hidden" value="<?php echo $brand->getProduct_ID(); ?>" name="product_id"/>
    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="user_id"/>
    <input type="hidden" value="<?php $brand->getName();?>" name="name"/>
    <!--                        -->
    <input type="submit" value="Add to Wishlist" class="btn"/>
</form>
<?php }?>