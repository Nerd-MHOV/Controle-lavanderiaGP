<?php
if (!empty($types)):
    foreach ($types as $type) :
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class='bx bx-closet'></i></div>
            </td>
            <td><h4><?=$type->product_type?></h4><span><?=$type->amountProducts()?> Produto(s)</span></td>
        </tr>
    <?php
    endforeach;
endif;
?>