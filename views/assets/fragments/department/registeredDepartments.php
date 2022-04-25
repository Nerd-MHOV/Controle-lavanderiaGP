<?php
if (!empty($departments)):
    foreach ($departments as $department):
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class="bx bxs-hard-hat"></i></div>
            </td>
            <td><h4><?= $department->department ?></h4><span><?= $department->departmentHeads() ?></span></td>
        </tr>
    <?php
    endforeach;
endif;
?>