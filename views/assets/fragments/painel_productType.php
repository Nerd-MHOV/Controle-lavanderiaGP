<?php
if (!empty($products)):
    foreach ($products as $product):
        foreach ($product->productTypes as $productType) {
            $type = $productType->product_type;
        }
        ?>
        <option value="<?= $product->id  ?>"><?= $type ?></option>
    <?php
    endforeach;
endif;