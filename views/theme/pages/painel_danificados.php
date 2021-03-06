<?= $this->layout("theme/_themeDashboard"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
<div class="details dw100">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>
            <!--
            <div>
                <a href="<?= $router->route("web-damaged.per-collaborator"); ?>" class="btnDashboard">Por colaborador</a>
            </div>
            -->
        </div>

        <table>
            <thead>
            <tr>
                <td>Nome</td>
                <td>Departamento</td>
                <td>Tipo</td>
                <td>Produto</td>
                <td>Oficio</td>
                <td>Tamanho</td>
                <td>Retirado</td>
                <td>Devolvido</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $this->insert(
                "assets/fragments/damaged/damagedCollaborators",
                ["damagedCollaborators" => $damagedCollaborators]
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
                <td>Tipo</td>
                <td>Produto</td>
                <td>Oficio</td>
                <td>Tamanho</td>
                <td>Retirado</td>
                <td>Devolvido</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $this->insert(
                "assets/fragments/damaged/damagedDepartments",
                ["damagedDepartments" => $damagedDepartments]
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
                url: '<?=$router->route("web-damaged.return_collaborator")?>',
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
                url: '<?=$router->route("web-damaged.return_department")?>',
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
