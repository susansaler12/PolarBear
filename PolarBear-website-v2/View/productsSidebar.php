<?php
$categories = ProductsDB::getCategory();
$brands = ProductsDB::getBrand();
?>
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