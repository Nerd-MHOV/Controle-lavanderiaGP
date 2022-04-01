<?= $this->layout("theme/_themeDashbord"); ?>
<div class="details dw50">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Nome</td>
                <td>Departamento</td>
                <td colspan="2">Produto</td>
                <td>Retirado</td>
                <td>Devolver</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $this->insert(
                "assets/fragments/painel_outputsCollaborator",
                ["pendingCollaborator" => $pendingCollaborator]
            );
            ?>
            </tbody>
        </table>
    </div>
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Setor:</h2>
        </div>
        <table>
            <thead>
            <tr>
                <td>Departamento</td>
                <td colspan="2">Produto</td>
                <td>Retirado</td>
                <td>Devolver</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $this->insert(
                "assets/fragments/painel_outputsDepartment",
                ["pendingDepartment" => $pendingDepartment]
            );
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL -->
<div id="myModal" class="modal">
    <?php
    $this->insert(
        "assets/fragments/painel_devolver_modal"
    )
    ?>
</div>

<?php $this->start("scripts") ?>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");


    openModal = function (id, department = false) {

        modal.style.display = "block";
        if (!department) {

            $.ajax({
                type: 'POST',
                data: {id_saida: id},
                url: '<?=$router->route("response.returncollaborator")?>',
                dataType: 'json',
                success: function (data) {
                    $('#myModal').html(data);
                }
            });

        } else {

            $(function () {
                $.ajax({
                    type: 'POST',
                    data: {id_saida: id},
                    url: '<?=$router->route("response.returndepartment")?>',
                    dataType: 'json',
                    success: function (data) {
                        $('#myModal').html(data);
                    }
                });
            });

        }

    }

    //SEPARATOR_____
    var span = document.getElementsByClassName('close-btn')[0];

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php $this->end() ?>
