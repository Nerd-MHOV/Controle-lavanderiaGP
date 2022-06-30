<form method="post" action="">
    <div id="modalphp" class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3><?= $collaborator->collaborator ?>:</h3>

            <div class="login_form_callback">
                <?= flash(); ?>
            </div>

        <div class="modal-wrapper">
            <div class="modal-single" style="margin: 0 10px">
                <h5>Departamento:</h5>
                <select class="ignoreClass" id="select_department" >

                    <?php
                    if (!empty($departments)):
                        foreach ($departments as $department):
                            ?>
                            <option value="<?= $department->id ?>" <?= ($collaborator->id_department == $department->id) ? 'selected' : '' ?>><?= $department->department ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>

            </div>



            <div class="modal-single" style="margin: 0 10px">
                <h5>Tipo:</h5>
                <select class="ignoreClass" id="select_type" required>
                    <?php
                    if (!empty($types)):
                        foreach ($types as $type):
                            ?>
                            <option value="<?= $type->id ?>" <?= ($collaborator->id_type == $type->id) ? 'selected' : '' ?>><?= $type->type ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>

            </div>

            <div class="modal-single" style="margin: 0 10px">
                <h5>Situação:</h5>
                <select class="ignoreClass" id="select_situation" required>
                    <option value="1" <?= ($collaborator->active == "1") ? 'selected' : '' ?> >Ativo</option>
                    <option value="0" <?= ($collaborator->active == "0") ? 'selected' : '' ?> >Desativado</option>
                </select>

            </div>



        </div>

        <br>
        <hr>
        <!-- order details list-->
        <div class="recentOrders">
            <div class="cardHeader">
                <h3>Pendencias</h3>

            </div>
            <table class="modal-table">
                <thead>
                <tr>
                    <td>Tipo</td>
                    <td>Produto</td>
                    <td>Oficio</td>
                    <td>Tamanho</td>
                    <td>Retirado</td>
                    <td style="text-align: center">Sem Validade</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($pendencies)):
                    foreach ($pendencies as $pendency):
                        ?>
                        <tr>
                            <td><?= $pendency->productType()->product_type ?></td>
                            <td><?= $pendency->product()->product ?></td>
                            <td><?= $pendency->productService()->service ?></td>
                            <td><?= $pendency->product()->size ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($pendency->created_at)) ?></td>
                            <td style="text-align: center"><input type="checkbox" data-id="<?=$pendency->id?>" class="check_validate" <?=($pendency->validate) ? "checked" : ""?>></td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<script src="<?=asset("js/form.js")?>"></script>

<script>
    //MUDAR DEPARTAMENTO
    $("#select_department").on("change", function () {
        let newDepartment = $(this).val()
        let collaborator = "<?= $collaborator->id ?>"
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?= $router->route("web-department.change_department") ?>",
            data: {
                newDepartment: newDepartment,
                collaborator: collaborator
            },beforeSend: function () {
                ajax_load("open");
            },
            success: function (callback) {
                if (callback.message) {
                    let view = '<div class="message ' + callback.message.type + '">' + callback.message.message + '</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                }
            },
            complete: function () {
                ajax_load("close");
            }
        })
    })

    //MUDAR O TIPO
    $("#select_type").on("change", function () {
        let newType = $(this).val()
        let collaborator = "<?= $collaborator->id ?>"

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?= $router->route("web-department.change_type") ?>",
            data: {
                newType: newType,
                collaborator: collaborator
            },
            beforeSend: function () {
                ajax_load('open')
            },
            success: function (callback) {
                console.log(callback)
                if (callback.message) {
                    let view = '<div class="message ' + callback.message.type + '">' + callback.message.message + '</div>'
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                }
            },
            complete: function () {
                ajax_load('close')
            }
        })
    })

    //MUDAR O TIPO
    $("#select_situation").on("change", function () {
        let newSituation = $(this).val()
        let collaborator = "<?= $collaborator->id ?>"

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?= $router->route("web-department.change_situation") ?>",
            data: {
                newSituation: newSituation,
                collaborator: collaborator
            },
            beforeSend: function () {
                ajax_load('open')
            },
            success: function (callback) {
                if (callback.message) {
                    let view = '<div class="message ' + callback.message.type + '">' + callback.message.message + '</div>'
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                }
            },
            complete: function () {
                ajax_load('close')
            }
        })
    })

    //SEM VALIDADE
    $(".check_validate").on("change", function () {
        let check_validate = $(this).prop("checked")
        let outputID = $(this).data("id")

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?=$router->route("web-department.validate_output")?>',
            data: {
                check_validate: check_validate,
                outputID: outputID
            },
            success: function (callback) {
                console.log(callback)
            }
        })
    })


</script>