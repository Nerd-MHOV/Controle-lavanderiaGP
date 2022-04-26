<?php
if (!empty($collaborators)):
    foreach ($collaborators as $collaborator):
        ?>
        <tr>
            <td>
                <div class="imgBx"><i class="bx bxs-hard-hat"></i></div>
            </td>
            <td><h4><?= $collaborator->collaborator ?></h4><span><?= $collaborator->department() ?></span></td>
        </tr>
    <?php
    endforeach;
endif;
?>