<?php
if (!empty($products)):
    foreach ($products as $product):
        ?>
        <option value="<?= $product->productType->id ?>">
            <?= $product->productType->product_type ?>
        </option>
    <?php
    endforeach;
endif;