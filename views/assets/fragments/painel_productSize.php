<?php
if (!empty($products)):
    echo "<option value=''>Selecione o tamanho</option>";
    foreach ($products as $product):
        ?>
        <option value="<?= $product->id  ?>"><?= $product->size ?></option>
    <?php
    endforeach;
endif;