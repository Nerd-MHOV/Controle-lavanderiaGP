<?php
if (isset($damagedDepartments) && !empty($damagedDepartments)):
    foreach ($damagedDepartments as $department) :
        ?>
        <tr data-id="<?= $department->id ?>">
            <td><?= $department->department()->department ?></td>
            <td><?= $department->productType()->product_type ?></td>
            <td><?= $department->product()->product ?></td>
            <td><?= $department->productService()->service ?></td>
            <td><?= $department->product()->size ?></td>
            <td><?= date("d/m H:i", strtotime($department->created_at)) ?></td>
            <td><span class="status inProgress" onclick="openModal(<?= $department->id ?>, true)"
                      style="cursor: pointer;">Status</span></td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='7' style='text-align: center'>Nenhum produto danificado pelos Setores</td> </tr>";
endif;
