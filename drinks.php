<fieldset>
    <legend>Products</legend>
    <?php foreach ($drinks AS $i => $drink): ?>
        <label>
            <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $drink['name'] ?> -
            &euro; <?php echo number_format($drink['price'], 2) ?></label><br />
    <?php endforeach; ?>
</fieldset>
