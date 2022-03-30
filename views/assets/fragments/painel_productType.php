<?php
if (!empty($products)):
    foreach ($products as $product):
        foreach ($product->productTypes as $productType) {
            $type = $productType->product_type;
            $id = $productType->id;
        }
        ?>
        <option value="<?= $id  ?>"><?= $type ?></option>
    <?php
    endforeach;
endif;