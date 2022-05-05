<?php
if (!empty($services)):
    foreach ($services as $service) :
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class='bx bxs-briefcase' ></i></div>
            </td>
            <td><h4><?=$service->service?></h4><span><?=$service->amountProducts()?> Produto(s)</span></td>
        </tr>
    <?php
    endforeach;
endif;
?>