<?php $this->layout("theme/_themeDashboard"); ?>
<!-- cards -->
<form class="form" action="<?= $router->route("response.withdrawal"); ?>" method="post" autocomplete="off">
    <div class="cardBox cardBox_retirar">
        <div class="card">
            <div>
                <div class="numbers">Departamento</div>
                <div class="cardName">
                    <select class="selectClass" name="departamento" id="select_department">
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
                <div class="cardName" style="width: 200px">
                    <select class="selectClass" name="colaborador" id="select_collaborators">

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
                <div class="cardName num_arrows">
                    <i class='bx bxs-left-arrow' onclick="less_itens()"></i>
                    <input type="number" value="0" min="1" id="nmb_qtdeRetiradas" disabled/>
                    <input type="hidden" name="qtde_itens" id="real_withdraws" value="0" />
                    <i class='bx bxs-right-arrow' onclick="more_itens()"></i>
                </div>
            </div>
            <div class="iconBx">
                <i class='bx bxs-backpack'></i>
            </div>
        </div>
    </div>

    <div class="containerPainel">
        <div class="tablePainel">
            <div class="login_form_callback">
                <?= flash(); ?>
            </div>
            <table>
                <thead>
                <tr id="tr_obs">
                    <th>Tipo</th>
                    <th>Oficio</th>
                    <th>Produto</th>
                    <th>Tamanho</th>
                    <th id="amnt_status">Estado</th>
                    <th id="th_obs">Obs</th>
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

    // Animação de carregamento!!!
    function ajax_load(action) {
        ajax_load_div = $(".ajax_load");

        if (action === "open") {
            ajax_load_div.fadeIn(200).css("display", "flex");
        }

        if (action === "close") {
            ajax_load_div.fadeOut(200);
        }
    }



    let select_collaborator = $("#select_collaborators");
    let nmb_qtdeRetiradas = $("#nmb_qtdeRetiradas");
    let real_withdraws = $("#real_withdraws");


    // DEPARTAMENTOS -> COLABORADOR
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
                nmb_qtdeRetiradas.val("0");
                real_withdraws.val("0")
                $("#tb_products").html("");
            },
            complete: function () {
                ajax_load("close");
            }
        })
    });




    // COLABORADOR -> QTDE RETIRADAS
    $("#select_collaborators").on("change", function () {
        nmb_qtdeRetiradas.val("0");
        real_withdraws.val("0")
        $("#tb_products").html("");
    });




    // ADICIONAR E RETIRAR LINHAS ( nmb_change() )
    function more_itens() {
        let val = $("#nmb_qtdeRetiradas").val();
        $("#nmb_qtdeRetiradas").val(parseInt(val) + 1)
        nmb_change();
        $("#real_withdraws").val($("#nmb_qtdeRetiradas").val())
    }
    function less_itens() {
        let val = $("#nmb_qtdeRetiradas").val();
        if (val !== "1" && val !== "0") {
            $("#nmb_qtdeRetiradas").val(parseInt(val) - 1)
            $("#tb_products tr:last").remove();
        }
        $("#real_withdraws").val($("#nmb_qtdeRetiradas").val())
    }



    // ADICIONAR LINHAS -> TIPO
    function nmb_change() {
        let select_department = $("#select_department").val();
        let select_collaborator = $("#select_collaborators").val();
        let nmb_qtdeRetiradas = $("#nmb_qtdeRetiradas").val();
        let tb_products = $("#tb_products");

        if (select_department !== "" && select_collaborator !== "") {

            $.ajax({
                type: "POST",
                url: "<?=$router->route("response.produtos")?>",
                data: {
                    id_collaborator: select_collaborator,
                    id_department: select_department,
                    qtdeRetiradas: nmb_qtdeRetiradas,
                },
                dataType: "json",
                beforeSend: function () {
                    ajax_load("open");
                },
                success: function (callback) {
                    if (callback.data.qtdeRetiradas) {
                        tb_products.append(callback.products);
                    }
                    if (select_collaborator === "0") {
                        $("#amnt_status").html("Qtde");
                        $("#th_obs").remove();
                    } else {
                        $("#amnt_status").html("Estado");
                        $("#tr_obs").html(`<th>Tipo</th>
                                            <th>Oficio</th>
                                            <th>Produto</th>
                                            <th>Tamanho</th>
                                            <th id="amnt_status">Estado</th>
                                            <th id="th_obs">Obs</th>`);
                    }

                },
                complete: function () {
                    ajax_load("close")
                }
            });
        }
    }



    // TIPO -> OFICIO
    function opt_service(ind) {
        let select_productType = $("#select_productType-" + ind).val();
        let select_productService = $("#select_productService-" + ind);
        let select_product = $("#select_product-" + ind);
        let select_size = $("#select_size-"+ind);
        let inp_amount = $("#amount-"+ind);
        let id_department = $("#select_department").val();


        $.ajax({
            type: "POST",
            url: "<?=$router->route("response.typeproducts")?>",
            data: {
                id_selectProductType: select_productType,
                id_department: id_department,
            },
            dataType: "json",
            beforeSend: function () {
                ajax_load("open");
            },
            success: function (callback) {
                select_productService.prop("disabled", false);
                select_product.prop("disabled", true);
                select_size.prop("disabled", true);
                inp_amount.prop("disabled", true);
                inp_amount.val("");
                if (callback.data.id_selectProductType) {
                    select_productService.html(callback.products);
                }else{
                    select_productService.prop("disabled", true);
                }
            },
            complete: function () {
                ajax_load("close");
            }
        })
    }



    // OFICIO -> PRODUTO
    function opt_product(ind) {
        let select_productService = $("#select_productService-" + ind).val();
        let select_productType = $("#select_productType-" + ind).val();
        let select_product = $("#select_product-" + ind);
        let select_size = $("#select_size-"+ind);
        let inp_amount = $("#amount-"+ind);
        let id_department = $("#select_department").val();

        $.ajax({
            type: "post",
            url: "<?=$router->route("response.product_service")?>",
            data: {
                id_productType: select_productType,
                id_productService: select_productService,
                id_department: id_department,
            },
            dataType: "json",
            beforeSend: function () {
                ajax_load("open");
            },
            success: function (callback) {
                select_size.prop("disabled", true);
                inp_amount.prop("disabled", true);
                inp_amount.val("");
                if (callback.data.id_productService) {
                    select_product.prop("disabled", false);
                    select_product.html(callback.products);
                } else {
                    select_product.prop("disabled", true);
                }
            },
            complete: function () {
                ajax_load("close");
            }
        })
    }



    // PRODUTO -> TAMANHO
    function opt_size(ind) {
        let select_productType = $("#select_productType-" + ind).val();
        let select_productService = $("#select_productService-" + ind).val();
        let select_product = $("#select_product-" + ind).val();
        let select_size = $("#select_size-" + ind);
        let inp_amount = $("#amount-"+ind);
        let id_department = $("#select_department").val();

        $.ajax({
            url: "<?=$router->route("response.product_send")?>",
            type: "post",
            dataType: "json",
            data: {
                id_productType: select_productType,
                id_productService: select_productService,
                id_department: id_department,
                product: select_product,
            },
            beforeSend: function () {
                ajax_load("open")
            },
            success: function (callback) {
                inp_amount.prop("disabled", true);
                inp_amount.val("");
                if (callback.data.product) {
                    select_size.prop("disabled", false);
                    select_size.html(callback.products);
                } else {
                    select_size.prop("disabled", true);
                }
            },
            complete: function () {
                ajax_load("close")
            }

        })
    }

</script>
<?php $this->end(); ?>
