<?php
if (!empty($products)):
    echo "<option value=''>Selecione o oficio</option>";
    foreach ($products as $product):
        ?>
        <option value="<?= ($product->productService())->id ?>" ><?= ($product->productService())->service ?></option>
    <?php
    endforeach;
endif;

