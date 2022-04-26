<?php
if (!empty($collaborators)):
    foreach ($collaborators as $collaborator):
        ?>
        <tr>
            <td><?= $collaborator->collaborator ?></td>
            <td><?= $collaborator->department() ?></td>
            <td><?= $collaborator->type() ?></td>
            <td><span class="status delivered">Ativo</span></td>
        </tr>
    <?php
    endforeach;
endif;
?>