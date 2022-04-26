<?php
if (!empty($types)):
    foreach ($types as $type):
        ?>
        <option value="<?= $type->id  ?>"><?= $type->type ?></option>
    <?php
    endforeach;
endif;