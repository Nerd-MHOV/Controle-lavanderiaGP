<?php
if (!empty($pendingCollaborator)):
    foreach ($pendingCollaborator as $collaborator) :
        ?>
        <tr data-id="<?=$collaborator->id?>">
            <td><?=$collaborator->collaborator()->collaborator?></td>
            <td><?=$collaborator->department()->department?></td>
            <td><?=$collaborator->productType()->product_type?></td>
            <td><?=$collaborator->product()->product?></td>
            <td><?=$collaborator->productService()->service?></td>
            <td><?=date("d/m H:i", strtotime($collaborator->created_at))?></td>
            <td><span class="status inProgress" onclick="openModal(<?=$collaborator->id?>)" style="cursor: pointer;">Devolver</span></td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='6' style='text-align: center'>Não exitem pendencias com os Colaboradores</td> </tr>";
endif;
?>