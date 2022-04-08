<?php
if (!empty($products)):
    echo "<option value=''>Selecione o oficio</option>";
    foreach ($products as $product):
        ?>
        <option value="<?= ($product->productServices())->id  ?>"><?= ($product->productServices())->service ?></option>
    <?php
    endforeach;
endif;