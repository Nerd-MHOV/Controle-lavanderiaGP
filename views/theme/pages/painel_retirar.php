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
                    $("#tb_products").html("");
                },
                complete: function () {
                    ajax_load("close");
                }
            })
        });

        $("#select_collaborators").on("change", function () {
            nmb_qtdeRetiradas.val("0");
            $("#tb_products").html("");
        });


        $("#nmb_qtdeRetiradas").on("change", function () {
            let val_productType = $("[id^=select_productType]").map(function () {
                return $(this).val();
            }).get();
            let val_productService = $("[id^=select_productService]").map(function () {
                return $(this).val();
            }).get();
            let val_product = $("[id^=select_product-]").map(function () {
                return $(this).val();
            }).get();
            let val_size = $("[id^=select_size-]").map(function () {
                return $(this).val();
            }).get();
            let val_amount = $("[id^=amount]").map(function () {
                return $(this).val();
            }).get();
            let val_status = $("[id^=select_status]").map(function () {
                return $(this).val();
            }).get();
            let val_obs = $("[id^=txta_obs]").map(function () {
                return $(this).val();
            }).get();

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

                    function fnc_productType(ind) {
                        $("#select_productType-" + ind).select2("val", val_productType[ind])
                        setTimeout(() => {
                            $("#select_productService-" + ind).select2("val", val_productService[ind])
                            setTimeout(() => {
                                let result = val_product[ind]
                                $("#select_product-" + ind).val(result).trigger('change')
                                setTimeout(() => {
                                    $("#select_size-" + ind).val(val_size[ind]).trigger('change')
                                    $("#amount-" + ind).val(val_amount[ind]);
                                    if (val_status[ind] !== "" && val_status[ind] !== "undefined") {
                                        setTimeout(() => {
                                            $("#select_status-" + ind).select2("val", val_status[ind])
                                            $("#txta_obs-" + ind).val(val_obs[ind])
                                        }, 1000)
                                    }
                                }, 1000)
                            }, 1000)
                        }, 1000)

                    }


                    for (i = 0; i <= val_productType.length; i++) {
                        if (val_productType[i] !== "" && val_productType[i] !== "undefined") {
                            fnc_productType(i)
                        }
                    }

                },
                complete: function () {
                    ajax_load("close")

                }
            });
        })
    })

</script>
<?php $this->end(); ?>
