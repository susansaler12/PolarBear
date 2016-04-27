<?php require_once '../Model/GordFeatures.php';
      require_once '../View/Header.php';
?>
<form action="#" method="post">
    <div>
        <label for="reviewSelect">Rating:</label>
        <select id="reviewSelect">
            <option value="">Choose a rating</option>
            <?php for($i = 0; $i < 6; $i++):?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php endfor ?>
        </select>
    </div>
    <div>
        <label for="reviewText">Comments:</label>
        <textarea id="reviewText"></textarea>
    </div>
    <input type="submit" id="reviewSubmit" value="Submit Review"/>
</form>
<?php require_once 'footer.php'?>