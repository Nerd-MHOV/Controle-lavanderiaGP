<?php
if (!empty($products)):
    foreach ($products as $product) :
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class="bx bxs-hard-hat"></i></div>
            </td>
            <td><h4><?=$product->product?></h4><span><?=$product->productType()->product_type." ".$product->product." ".$product->productService()->service?></span></td>
        </tr>
    <?php
    endforeach;
endif;
?>