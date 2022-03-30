<?php

if (!empty($products)):
    foreach ($products as $product):
        ?>
        <option value="<?= $product->id  ?>"><?= $product->product ?></option>
    <?php
    endforeach;
endif;
?>