<?php
if (!empty($products)):
    foreach ($products as $product) :
        ?>
        <tr data-id="<?=$product->id?>">
            <td><?=$product->department?></td>
            <td><?=$product->product_type?></td>
            <td><?=$product->product?></td>
            <td><?=$product->service?></td>
            <td><?=$product->size?></td>
            <td><?=date("d/m H:i", strtotime($product->updated_at))?></td>
            <td><span class="status inProgress" onclick="openModal(<?=$product->id?>)" style="cursor: pointer;">Devolver</span></td>
        </tr>
    <?php
    endforeach;
else:
    echo "<tr> <td colspan='8' style='text-align: center'>Não foi encontrado nada na pesquisa!</td> </tr>";
endif;
?>