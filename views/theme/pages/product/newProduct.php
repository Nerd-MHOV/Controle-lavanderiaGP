<?php

use Source\Controllers\Controller;
use Source\Controllers\WebProduct;

/** @var Controller $router */
/** @var WebProduct $types */
/** @var WebProduct $services */
/** @var WebProduct $departments */
/** @var WebProduct $products */
$this->layout("theme/_themeDashboard"); ?>
<div class="grid_newProduct">
    <form class="" action="<?= $router->route("web-product.register-product"); ?>" method="post" autocomplete="off">
        <div class="grid_newProduct_register">
            <div class="cardBox cardBox_newProduct">
                <div class="card">
                    <div>
                        <div class="numbers">Tipo</div>
                        <div class="cardName" style="width: 200px">
                            <label>
                                <select class="selectClass" name="select_type" id="select_type">
                                    <option value="">Selecione o tipo</option>
                                    <?php
                                    $this->insert(
                                        "assets/fragments/product/select_types",
                                        ['types' => $types]
                                    );
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="iconBx iconBx_retirar">
                        <i class='bx bxs-hard-hat'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">Oficio</div>
                        <div class="cardName" style="width: 200px">
                            <label>
                                <select class="selectClass" name="select_service" id="select_service" disabled>
                                    <option value="">Selecione o oficio</option>
                                    <?php
                                    $this->insert(
                                        "assets/fragments/product/select_services",
                                        ['services' => $services]
                                    );
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="iconBx">
                        <i class='bx bx-user'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">Departamento</div>
                        <div class="cardName" style="width: 200px">
                            <label>
                                <select class="selectClass" disabled id="select_department" name="select_department">
                                    <option value="">Selecione o departamento</option>
                                    <?php
                                    $this->insert(
                                        "assets/fragments/product/select_departments",
                                        ['departments' => $departments]
                                    );
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="iconBx">
                        <i class='bx bx-user'></i>
                    </div>
                </div>
            </div>
            <div class="login_form_callback center20px">
                <?= flash(); ?>
            </div>
            <div class="containerPainel">
                <div class="cardHeader">
                    <h2>Novo produto:</h2>
                    <a href="<?= $router->route("painel.produto") ?>" class="btnDashboard">voltar</a>
                </div>
                <div class="form-register" style="position: relative; top: 0">
                    <div class="form-registerType">
                        <div class="container-box-register">
                            <div class="box-register">
                                <label for="inp_product">Produto:</label>
                                <input type="text" name="inp_product" id="inp_product"
                                       placeholder="qual o novo produto..." disabled/>
                            </div>
                            <div class="box-register">
                                <label for="inp_unitaryValue">Valor Unitario:</label>
                                <input class="moneyMask" type="text" name="inp_unitaryValue" id="inp_unitaryValue"
                                       placeholder="qual o valor unitario..." disabled/>
                            </div>
                            <div class="box-register">
                                <label for="inp_amount">Qtde:</label>
                                <input class="onlyNum" type="text" name="inp_amount" id="inp_amount"
                                       placeholder="quantidade para estoque" disabled/>
                            </div>
                        </div>

                        <div class="buttons-form">
                            <input class="btn btn-blue" id="inp_submit" type="submit" value="cadastrar!" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="grid_newProduct_list">
        <div class="recentCustomers recentCustomers_newProduct">
            <div class="cardHeader">
                <h2>Cadastrados:</h2>
            </div>
            <table id="reloadRegistered">
                <?php
                $this->insert(
                    "assets/fragments/product/registeredProducts",
                    ["products" => $products]
                );
                ?>
            </table>
        </div>
    </div>
</div>

<?php $this->start("scripts"); ?>
<script>
    $('#select_type').on("change", function () {
        if ($(this).val() !== "") {
            $("#select_service").prop("disabled", false);
            $("#select_service").select2("val", 0)
        } else {
            $("#select_service").select2("val", 0)
            $("#select_service").prop("disabled", true);

            $("#select_department").select2("val", 0)
            $("#select_department").prop("disabled", true);
        }
    })

    $("#select_service").on("change", function () {
        if ($(this).val() !== "") {
            $("#select_department").prop("disabled", false);
        } else {
            $("#select_department").select2("val", 0)
            $("#select_department").prop("disabled", true);
        }
    })

    $('#select_department').on("change", function () {
        if ($(this).val() !== "") {
            $("#inp_product").prop("disabled", false);
            $("#inp_unitaryValue").prop("disabled", false);
            $("#inp_amount").prop("disabled", false);
            $("#inp_submit").prop("disabled", false);

            let type = $('#select_type').val()
            let service = $('#select_service').val()
            let department = $('#select_department').val()
            $.ajax({
                type: "POST",
                url: "<?=$router->route("web-product.reload-products")?>",
                data: {
                    type: type,
                    service: service,
                    department: department
                },
                dataType: 'json',
                success: function (callback) {
                    $("#reloadRegistered").html(callback.reload);
                }
            })
        } else {
            $("#inp_product").prop("disabled", true);
            $("#inp_unitaryValue").prop("disabled", true);
            $("#inp_amount").prop("disabled", true);
            $("#inp_submit").prop("disabled", true);
        }
    })
</script>
<?php $this->end(); ?>
