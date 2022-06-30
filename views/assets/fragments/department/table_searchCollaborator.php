<?php
if (!empty($collaborators)):
    foreach ($collaborators as $collaborator):
        ?>
        <tr onclick="openModal(<?=$collaborator->id?>)">
            <td><?= $collaborator->collaborator ?></td>
            <td><?= $collaborator->department ?></td>
            <td><?= $collaborator->type ?></td>
            <td><span class="status <?= ($collaborator->active) ? "delivered" : "return"?>"><?= ($collaborator->active) ? "Ativo" : "Desativado"?></span></td>
        </tr>
    <?php
    endforeach;
endif;
?>