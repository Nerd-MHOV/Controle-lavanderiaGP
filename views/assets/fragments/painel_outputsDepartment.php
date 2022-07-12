<?php
if (!empty($pendingDepartment)):
    foreach ($pendingDepartment as $department) :
        ?>
        <tr data-id="<?=$department->id?>">
            <td><?=$department->department()->department?></td>
            <td><?=$department->productType()->product_type?></td>
            <td><?=$department->product()->product?></td>
            <td><?=$department->productService()->service?></td>
            <td><?=$department->product()->size?></td>
            <td><?=$department->amount?></td>
            <td><?=date("d/m H:i", strtotime($department->created_at))?></td>
            <td><span class="status inProgress" onclick="openModal(<?=$department->id?>, true)" style="cursor: pointer;">Devolver</span></td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='7' style='text-align: center'>Nenhuma pendencia com os Setores</td> </tr>";
endif;
?>