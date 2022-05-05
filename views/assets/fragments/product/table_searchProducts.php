<?php
if (!empty($products)):
    foreach ($products as $p):
        ?>
        <tr>
            <td><?= $p->product_type ?></td>
            <td><?= $p->product ?></td>
            <td><?= $p->service ?></td>
            <td><?= $p->size ?></td>
            <td><?= $p->unitary_value ?></td>
            <td><?= $p->department ?></td>
            <?php
            if ($p->status == "A"):
                echo "<td><span class=\"status delivered\">Ativo</span></td>";
            elseif ($p->status == "D"):
                echo "<td><span class=\"status return\">Desativado</span></td>";
            endif;
            ?>
        </tr>
    <?php
    endforeach;
endif;
?>