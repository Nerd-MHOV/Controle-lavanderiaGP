<?php $this->layout("theme/_themeDashboard"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders" style="min-height: 800px">
        <div class="cardHeader">
            <h2>Cadastrar Colaborador:</h2>
            <a href="<?= $router->route("painel.departamento") ?>" class="btnDashboard">voltar</a>
        </div>

        <div class="back-register">
            <i class='bx bxs-user-circle'></i>
        </div>

        <div class="form-register">
            <form class="form-registerType" action="<?= $router->route("web-department.register-collaborator") ?>"
                  method="post" autocomplete="off">
                <div class="container-box-register">
                    <div class="box-register">
                        <label for="inp_department">Departamento:</label>
                        <div class="selectForm">
                            <select class="selectClass" name="select_department" id="select_department">
                                <option value="">Selecione o departamento...</option>
                                <?php
                                $this->insert(
                                    "assets/fragments/product/select_departments",
                                    ["departments" => $departments]
                                );
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-register">
                        <label for="select_type">Tipo:</label>
                        <div class="selectForm">
                            <select class="selectClass" name="select_type" id="select_type" disabled>
                                <option value="">Selecione a forma de trabalho...</option>
                                <?php
                                $this->insert(
                                    "assets/fragments/department/select_collaboratorTypes",
                                    ["types" => $types]
                                )
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-register">
                        <label for="inp_collaborator">Colaborador:</label>
                        <input type="text" name="inp_collaborator" id="inp_collaborator" placeholder="qual o nome..."
                               disabled/>
                    </div>
                    <div class="box-register">
                        <label for="inp_cpf">CPF:</label>
                        <input class="cpfMask" type="text" name="inp_cpf" id="inp_cpf" placeholder="informe o CPF..."
                               disabled/>
                    </div>
                </div>
                <div class="buttons-form">
                    <input class="btn btn-blue" type="submit" value="cadastrar!"/>
                </div>
            </form>
        </div>
    </div>

    <!-- New Customers -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Cadastrados:</h2>
        </div>
        <table id="tbl_registeredTypes">
            <?php
            $this->insert(
                "assets/fragments/department/registeredCollaborators",
                ['collaborators' => $collaborators]
            );
            ?>
        </table>
    </div>


</div>

<?php $this->start("scripts"); ?>
<script>
    $("#select_department").on("change", function () {
        if ($(this).val() !== "") {
            $("#select_type").prop("disabled", false)
            let department = $(this).val()
            $.ajax({
                type: "POST",
                url: "<?= $router->route("web-department.reload-collaborators") ?>",
                data: {department: department},
                dataType: 'json',
                success: function (callback) {
                    $("#tbl_registeredTypes").html(callback.reload);
                }
            })
        } else {
            $("#select_type").prop("disabled", true)
        }
    })

    $("#select_type").on("change", function () {
        if ($(this).val() !== "") {
            $("#inp_collaborator").prop("disabled", false)
        } else {
            $("#inp_collaborator").prop("disabled", true)
        }
    })

    $("#inp_collaborator").on("change", function () {
        if ($(this).val() !== "") {
            $("#inp_cpf").prop("disabled", false)
        } else {
            $("#inp_cpf").prop("disabled", true)
        }
    })
</script>
<?php $this->end(); ?>
