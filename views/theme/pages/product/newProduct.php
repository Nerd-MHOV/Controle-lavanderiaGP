<?php $this->layout("theme/_themeDashbord"); ?>
<div class="grid_newProduct">
    <form class="" action="<?= $router->route("web-product.register-product"); ?>" method="post" autocomplete="off">
    <div class="grid_newProduct_register">
        <div class="cardBox cardBox_newProduct">
            <div class="card">
                <div>
                    <div class="numbers">Tipo</div>
                    <div class="cardName" style="width: 200px">
                        <select class="selectClass" name="select_type" id="select_type">
                            <option value="">Selecione o tipo</option>
                            <?php
                            $this->insert(
                                "assets/fragments/product/select_types",
                                ['types' => $types]
                            );
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
                    <div class="numbers">Oficio</div>
                    <div class="cardName" style="width: 200px">
                        <select class="selectClass" name="select_service" id="select_service" disabled>
                            <option value="">Selecione o oficio</option>
                            <?php
                            $this->insert(
                                "assets/fragments/product/select_services",
                                ['services' => $services]
                            );
                            ?>
                        </select>
                    </div>
                </div>
                <div class="iconBx">
                    <i class='bx bx-user'></i>
                </div>
            </div>
        </div>
        <div class="login_form_callback">
            <?  flash(); ?>
        </div>
        <div class="containerPainel">
            <div class="cardHeader">
                <h2>Novo produto:</h2>
                <a href="<?= $router->route("painel.produto") ?>" class="btnDashbord">voltar</a>
            </div>
            <div class="form-register" style="position: relative; top: 0">
                <div class="form-registerType">
                    <div class="container-box-register">
                        <div class="box-register">
                            <label for="inp-typeregister">Produto:</label>
                            <input type="text" name="inp_product" id="inp_product" placeholder="qual o novo produto..." disabled />
                        </div>
                        <div class="box-register">
                            <label for="inp-typeregister">Valor Unitario:</label>
                            <input class="moneyMask" type="text" name="inp_unitaryValue" id="inp_unitaryValue" placeholder="qual o valor unitario..." disabled />
                        </div>
                        <div class="box-register">
                            <label for="inp-typeregister">Qtde:</label>
                            <input type="text" name="inp_amount" id="inp_amount" placeholder="quantidade para estoque" disabled />
                        </div>
                    </div>

                    <div class="buttons-form">
                        <input class="btn btn-blue" type="submit" value="cadastrar!" disabled />
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
                <table>
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
    $("#select_type").on("change", function() {
        
    })
</script>
<?php $this->end(); ?>
