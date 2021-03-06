<?php
if (isset($damagedCollaborators) && !empty($damagedCollaborators)):
    foreach ($damagedCollaborators as $collaborator) :
        ?>
        <tr data-id="<?= $collaborator->id ?>">
            <td><?= $collaborator->collaborator()->collaborator ?></td>
            <td><?= $collaborator->department()->department ?></td>
            <td><?= $collaborator->productType()->product_type ?></td>
            <td><?= $collaborator->product()->product ?></td>
            <td><?= $collaborator->productService()->service ?></td>
            <td><?= $collaborator->product()->size ?></td>
            <td><?= date("d/m H:i", strtotime($collaborator->date_in)) ?></td>
            <td><?= date("d/m H:i", strtotime($collaborator->date_out)) ?></td>
            <td><span class="status inProgress" onclick="openModal(<?= $collaborator->id ?>)"
                      style="cursor: pointer;">Status</span>
            </td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='9' style='text-align: center'>Nenhum produto danificado pelos Colaboradores</td> </tr>";
endif;
