<?= $this->layout("theme/_themeDashboard"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
<div class="details dw100">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>

            <!-- search -->
            <div class="searchRight">
                <div class="search">
                    <label>
                        <input id="searchBar" type="text" placeholder="Buscar" />
                        <i class='bx bx-search'></i>
                    </label>
                </div>
            </div>

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
                <td>Devolver</td>
            </tr>
            </thead>
            <tbody id="bodyResponse">
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

            <!-- search -->
            <div class="searchRight">
                <div class="search">
                    <label>
                        <input id="searchBar2" type="text" placeholder="Buscar" />
                        <i class='bx bx-search'></i>
                    </label>
                </div>
            </div>

        </div>
        <table>
            <thead>
            <tr>
                <td>Departamento</td>
                <td>Tipo</td>
                <td>Produto</td>
                <td>Oficio</td>
                <td>Tamanho</td>
                <td>Qtde</td>
                <td>Retirado</td>
                <td>Devolver</td>
            </tr>
            </thead>
            <tbody id="bodyResponse2">
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

    $('#searchBar').keyup(function () {
        let search = $(this).val();
        $.ajax({
            url: "<?= $router->route("web-return.search_collaborator"); ?>",
            type: "post",
            data: {search: search},
            dataType: "json",
            success: function (callback) {
                $("#bodyResponse").html(callback.response);
            }
        })
    });

    $('#searchBar2').keyup(function () {
        let search = $(this).val();
        $.ajax({
            url: "<?= $router->route("web-return.search_department"); ?>",
            type: "post",
            data: {search: search},
            dataType: "json",
            success: function (callback) {
                $("#bodyResponse2").html(callback.response);
            }
        })
    });

    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");


    openModal = function (id, department = false) {

        if (!department) {

            $.ajax({
                type: 'POST',
                data: {id_saida: id},
                url: '<?=$router->route("web-return.return_collaborator")?>',
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
                url: '<?=$router->route("web-return.return_department")?>',
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
