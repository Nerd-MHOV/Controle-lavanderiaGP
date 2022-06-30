<?php

use Source\Controllers\WebControl;

/** @var WebControl $recents ::tableOutputs() */
/** @var WebControl $date_in ::tableOutputs() */
/** @var WebControl $date_out ::tableOutputs() */

?>
<div class="recentOrders">
    <div class="cardHeader">
        <h2>Retirados</h2>

        <!-- FILTERS -->
        <div>
            <div class="select-filter">
                <div class="box-date-filter">
                    <div class="text-date-filter">
                        De:
                    </div>
                    <input type="date" value="<?= $date_in ?>" id="date_in">
                </div>
                <div class="box-date-filter">
                    <div class="text-date-filter">
                        Até:
                    </div>
                    <input type="date" value="<?= $date_out ?>" id="date_out">
                </div>
            </div>
            <div class="select-filter ">
                <div id="filter-department" class="box-select-filter pointer <?= ($filterCollaborator == " AND id_collaborator LIKE 0 ") ? "box-select-filter-selected" : "" ?>">
                    <div class="text-select-filter ">
                        Departamento
                    </div>
                </div>
                <div id="filter-collaborator" class="box-select-filter pointer <?= ($filterCollaborator == " AND id_collaborator != 0 ") ? "box-select-filter-selected" : "" ?>">
                    <div class="text-select-filter " >
                        Colaborador
                    </div>
                </div>
                <div class="box-select-filter">
                    <div class="text-select-filter">
                        Total: <?= ($recents) ? count($recents) : 0 ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <table>
        <thead>
        <tr>
            <td>Colaborador</td>
            <td>Departamento</td>
            <td>Tipo</td>
            <td>Produto</td>
            <td>Oficio</td>
            <td>Tamanho</td>
            <td>Quantidade</td>
            <td>Status</td>
            <td>Retirado</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($recents)):
            foreach ($recents as $recent):
                ?>
                <tr>
                    <td><?= $recent->collaborator()->collaborator ?><?= ($recent->id_collaborator == 0) ? " - {$recent->responsible()}" : "" ?></td>
                    <td><?= ($recent->id_collaborator != 0) ? $recent->collaborator()->department() : $recent->department()->department ?></td>
                    <td><?= $recent->productType()->product_type ?></td>
                    <td><?= $recent->product()->product ?></td>
                    <td><?= $recent->productService()->service ?></td>
                    <td><?= $recent->product()->size ?></td>
                    <td><?= $recent->amount ?></td>
                    <td><?= $recent->status ?></td>
                    <td><?= date("d/m H:i", strtotime($recent->created_at)) ?></td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
</div>

<script>
    $(".pointer.box-select-filter").on("click", function () {
        let filterCollaborator = this.children[0].textContent
        if(!$(this).hasClass("box-select-filter-selected")) {
            if (filterCollaborator.match(/Departamento/))
                filterCollaborator = "department"
            if (filterCollaborator.match(/Colaborador/))
                filterCollaborator = "collaborator"
        }

        let date_in = $("#date_in").val();
        let date_out = $("#date_out").val();
        $.ajax({
            type: "POST",
            data: {
                filterCollaborator: filterCollaborator,
                reference: "<?=$reference?>",
                date_in: date_in,
                date_out: date_out,
            },
            url: '<?= $router->route("web-control.table_outputs") ?>',
            dataType: 'json',
            success: function (data) {
                $("#response").html(data.response)
            }
        })
    });


    $("#date_in").on("change", function () {
        let filterCollaborator = ""
        if($("#filter-department").hasClass("box-select-filter-selected"))
            filterCollaborator = "department"
        if($("#filter-collaborator").hasClass("box-select-filter-selected"))
            filterCollaborator = "collaborator"

        let date_in = $("#date_in").val();
        let date_out = $("#date_out").val();
        $.ajax({
            type: "POST",
            data: {
                filterCollaborator: filterCollaborator,
                reference: "<?=$reference?>",
                date_in: date_in,
                date_out: date_out,
            },
            url: '<?= $router->route("web-control.table_outputs") ?>',
            dataType: 'json',
            success: function (data) {
                $("#response").html(data.response)
            }
        })
    });

    $("#date_out").on("change", function () {
        let filterCollaborator = ""
        if($("#filter-department").hasClass("box-select-filter-selected"))
            filterCollaborator = "department"
        if($("#filter-collaborator").hasClass("box-select-filter-selected"))
            filterCollaborator = "collaborator"

        let date_in = $("#date_in").val();
        let date_out = $("#date_out").val();
        $.ajax({
            type: "POST",
            data: {
                filterCollaborator: filterCollaborator,
                reference: "<?=$reference?>",
                date_in: date_in,
                date_out: date_out,
            },
            url: '<?= $router->route("web-control.table_outputs") ?>',
            dataType: 'json',
            success: function (data) {
                $("#response").html(data.response)
            }
        })
    });
</script>