<?php

if (!empty($products)):
    echo "<option value=''>Selecione o produto</option>";
    foreach ($products as $product):
        ?>
        <option value="<?= $product->product  ?>"><?= $product->product ?></option>
    <?php
    endforeach;
endif;
?>