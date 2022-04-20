<?php
if (!empty($types)):
    foreach ($types as $type):
        ?>
        <option value="<?= $type->id  ?>"><?= $type->product_type ?></option>
    <?php
    endforeach;
endif;