<?php
if (!empty($products)):
    foreach ($products as $product):
        ?>
        <option value="<?= $product->productTypes->id  ?>"><?= $product->productTypes->product_type ?></option>
    <?php
    endforeach;
endif;