<?php
$categories = ProductsDB::getCategory();
$brands = ProductsDB::getBrand();
?>

<h3>Search by Brand</h3>
<ul>
    <?php foreach ($brands as $brand) : ?>
        <li>
            <a href="../Controller/productController.php?brand=<?php echo $brand['brand']; ?>">
                <?php echo $brand['brand']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Search by Category</h3>
<ul>
    <?php foreach ($categories as $category) : ?>
        <li>
            <a href="../Controller/productController.php?category=<?php echo $category['category']; ?>">
                <?php echo $category['category']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
