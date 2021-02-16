<fieldset>
    <legend>Products</legend>
    <?php foreach ($sandwiches AS $i => $sandwich): ?>
        <label>
            <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $sandwich['name'] ?> -
            &euro; <?php echo number_format($sandwich['price'], 2) ?></label><br />
    <?php endforeach; ?>
</fieldset>
