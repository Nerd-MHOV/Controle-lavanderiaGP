<?php
if (!empty($departments)):
    foreach ($departments as $department):
        ?>
        <option value="<?= $department->id  ?>"><?= $department->department ?></option>
    <?php
    endforeach;
endif;