<?php $this->layout("theme/_themeDashbord"); ?>
<div class="login_form_callback center20px">
    <?= flash(); ?>
</div>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Cadastrar Colaborador:</h2>
            <a href="<?= $router->route("painel.departamento") ?>" class="btnDashbord">voltar</a>
        </div>

        <div class="back-register">
            <i class="bx bxs-hard-hat"></i>
        </div>

        <div class="form-register">
            <form class="form-registerType" action="<?=$router->route("web-department.register-collaborator")?>" method="post" autocomplete="off">
                <div class="box-register">
                    <label for="inp_department">Colaborador:</label>
                    <input type="text" name="inp_department" id="inp_department" placeholder="qual o nome do novo collaborador...">
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
                "assets/fragments/department/registeredDepartments",
                ['departments' => $departments]
            );
            ?>
        </table>
    </div>


</div>