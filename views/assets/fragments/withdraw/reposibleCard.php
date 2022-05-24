<?php
use Source\Controllers\Response;

/** @var $id_collaborator Response:product() */
/** @var $id_department Response:product() */
/** @var $selected Response:product() */

if($id_collaborator == 0): ?>
<div class="responsibleCard responsibleBox">
    <div>
        <div class="responsibleTitle">Retirante</div>
        <div class="responsibleSelect">
            <select class="selectClass" name="responsible" id="select_responsible" data-placeholder="Selecione um responsavel">
                <option value=""></option>
                <?php
                if (!empty($collaborators)):
                    foreach ($collaborators as $collaborator):
                        ?>
                        <option value="<?= $collaborator->id ?>"
                            <?php if($collaborator->id == $selected) {echo "selected";} ?>
                        ><?= $collaborator->collaborator ?></option>
                    <?php
                    endforeach;
                endif;
                ?>
            </select>
        </div>
    </div>
</div>

<script>
    $("#select_responsible").select2();
</script>
<?php endif; ?>
