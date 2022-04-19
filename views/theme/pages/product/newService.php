<?php $this->layout("theme/_themeDashbord"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Cadastrar Oficio:</h2>
            <a href="<?= $router->route("painel.produto") ?>" class="btnDashbord">voltar</a>
        </div>

        <div class="back-register">
            <i class="bx bxs-hard-hat"></i>
        </div>

        <div class="form-register">
            <form class="form-registerType" action="<?=$router->route("web-product.register-service")?>" method="post">
                <div class="box-register">
                    <label for="inp-typeregister">Oficio:</label>
                    <input type="text" name="inp-typeregister" id="inp-typeregister" placeholder="qual o novo oficio...">
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
                "assets/fragments/product/registeredServices",
                ['services' => $services]
            );
            ?>
        </table>
    </div>


</div>