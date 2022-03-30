<!--validar permissão (1)-->
<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<form action="">
<div class="cardBox cardBox_retirar">
    <div class="card">
        <div>
            <div class="numbers">Departamento</div>
            <div class="cardName">
                <select name="departamento" id="select_department">
                    <option value="">Selecione o departamento</option>
                    <?php
                    if (!empty($departments)):
                        foreach ($departments as $department):
                            $this->insert(
                                "assets/fragments/painel_alldepartments",
                                ['id_department' => $department->id, 'department' => $department->department]
                            );
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
        <div class="iconBx iconBx_retirar">
            <i class='bx bxs-hard-hat'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">Colaborador</div>
            <div class="cardName">
                <select name="colaborador" id="select_collaborators">

                </select>
            </div>
        </div>
        <div class="iconBx">
            <i class='bx bx-user'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">Qtde de retiradas</div>
            <div class="cardName">
                <input type="number" name="qtde_itens" value="0" min="1" id="nmb_qtdeRetiradas" disabled/>
            </div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-backpack'></i>
        </div>
    </div>
</div>

<div class="containerPainel">
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th colspan="2">Produto</th>
                <th>Estado</th>
                <th>Obs:</th>
            </tr>
            </thead>
            <tbody id="tb_products">

            </tbody>
        </table>
    </div>
    <div class="buttonRetirar">
        <button class="btn btn-green">Retirar!</button>
    </div>
</div>
</form>

<?php $this->start("scripts"); ?>
<script>
    function ajax_load(action) {
        ajax_load_div = $(".ajax_load");

        if (action === "open") {
            ajax_load_div.fadeIn(200).css("display", "flex");
        }

        if (action === "close") {
            ajax_load_div.fadeOut(200);
        }
    }
    $(function () {
        let select_collaborator = $("#select_collaborators");
        let nmb_qtdeRetiradas = $("#nmb_qtdeRetiradas");



        $("#select_department").on("change", function () {
            let select_department = $(this).val();


            $.ajax({
                type: "POST",
                url: "<?=$router->route("response.colaborador")?>",
                data: {
                    id_department: select_department
                },
                dataType: "json",
                beforeSend: function () {
                    ajax_load("open");
                },
                success: function (callback) {
                    if (callback.data.id_department) {
                        select_collaborator.html(callback.collaborators);
                    }
                    nmb_qtdeRetiradas.prop("disabled", false);
                    nmb_qtdeRetiradas.val("0");
                },
                complete: function () {
                    ajax_load("close");
                }
            })
        });

        $("#nmb_qtdeRetiradas").on("change", function() {
            let select_department = $("#select_department").val();
            let select_collaborator = $("#select_collaborators").val();
            let nmb_qtdeRetiradas = $(this).val();
            let tb_products = $("#tb_products");

            $.ajax({
                type: "POST",
                url: "<?=$router->route("response.produtos")?>",
                data: {
                    id_collaborator: select_collaborator,
                    id_department: select_department,
                    qtdeRetiradas: nmb_qtdeRetiradas
                },
                dataType: "json",
                beforeSend: function () {
                    ajax_load("open");
                },
                success: function (callback) {
                    if (callback.data.qtdeRetiradas) {
                        tb_products.html(callback.products);
                    }
                },
                complete: function () {
                    ajax_load("close");
                }
            });
        })
    })
</script>
<?php $this->end(); ?>
