<?php
if (!empty($products)):
    foreach ($products as $p):
        $product = (new \Source\Models\Product())->findById($p->id)
        ?>
        <tr>
            <td><?= $p->product_type ?></td>
            <td><?= $p->product ?></td>
            <td><?= $p->service ?></td>
            <td><?= $p->department ?></td>
            <td><?= $product->inInventory() ?></td>
            <td><?= $product->inOutput() ?></td>
            <td><?= $product->amountOutInv() ?></td>
        </tr>
    <?php
    endforeach;
endif;
?>