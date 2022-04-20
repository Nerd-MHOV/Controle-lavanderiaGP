<?php
if (!empty($services)):
    foreach ($services as $service):
        ?>
        <option value="<?= $service->id  ?>"><?= $service->service ?></option>
    <?php
    endforeach;
endif;