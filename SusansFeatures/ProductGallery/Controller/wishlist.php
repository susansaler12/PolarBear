<?php
?>

<div>
    <h3>Search by Brand</h3>
    <ul class="side-nav">
        <?php foreach ($wishes as $wish) : ?>
            <li>
                <a href="?wish=<?php echo $wish['wish_id']; ?>">
                    <?php echo $wish['wish_id']; ?>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>
</div>

<div>
                <?php foreach($wishes as $wish) {
    echo $wish->getName() . " " . '<br />' . $wish->getPrice();

    ?>

    <form action="." method="post">-->
        <p><a href="wishlist.php" class="btn">Add to Wishlist</a></p>
        <input type="submit" value="Add to Wishlist" />
    </form>
<?php }?>
</div>