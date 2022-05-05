<?php
if (!empty($products)):
    foreach ($products as $product) :
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class='bx bx-purchase-tag'></i></div>
            </td>
            <td><h4><?=$product->product." ".$product->size?></h4><span><?=$product->productType()->product_type." ".$product->productService()->service?></span></td>
        </tr>
    <?php
    endforeach;
endif;
?>