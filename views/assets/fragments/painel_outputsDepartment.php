<?php
if (!empty($pendingDepartment)):
    foreach ($pendingDepartment as $department) :
        ?>
        <tr>
            <td><?=($department->department())->department?></td>
            <td><?=($department->productType(($department->product())->id_product_type))->product_type?></td>
            <td><?=($department->product())->product?></td>
            <td><?=($department->productService(($department->product())->id_product_service))->service?></td>
            <td><?=date("d/m H:i", strtotime($department->created_at))?></td>
            <td><span class="status inProgress" onclick="openModal(<?=$department->id?>, true)" style="cursor: pointer;">Devolver</span></td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='5' style='text-align: center'>Nenhuma pendencia com os Setores</td> </tr>";
endif;
?>