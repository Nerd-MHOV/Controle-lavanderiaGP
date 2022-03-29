<?php
if (!empty($collaborators)):
    foreach ($collaborators as $collaborator):
        ?>
        <option value="<?= $collaborator->id ?>"><?= $collaborator->collaborator ?></option>
    <?php
    endforeach;
endif;
?>