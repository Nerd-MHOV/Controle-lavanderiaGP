<?= $this->layout("theme/_themeDashbord"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
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
                <td colspan="3">Produto</td>
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
                <td colspan="3">Produto</td>
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

<!-- MODAL  -->
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

        if (!department) {

            $.ajax({
                type: 'POST',
                data: {id_saida: id},
                url: '<?=$router->route("response.return_collaborator")?>',
                dataType: 'json',
                success: function (data) {

                    $('#myModal').html(data.modal);
                    modal.style.display = "block";
                }
            });

        } else {


            $.ajax({
                type: 'POST',
                data: {id_saida: id},
                url: '<?=$router->route("response.return_department")?>',
                dataType: 'json',
                success: function (data) {
                    $('#myModal').html(data.modal);
                    modal.style.display = "block";
                }
            });

        }

    }


    closeModal = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
<?php $this->end() ?>
