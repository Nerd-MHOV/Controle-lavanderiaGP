<?php $this->layout("theme/_themeDashbord"); ?>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>
            <a href="" class="btnDashbord">Novo</a>
        </div>
        <table>
            <thead>
            <tr>
                <td>Nome</td>
                <td>Departamento</td>
                <td>Tipo</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Matheus Henrique</td>
                <td>Monitoria</td>
                <td>Mensalista</td>
                <td><span class="status delivered">Ativo</span></td>
            </tr>
            <tr>
                <td>Fernando Amaral</td>
                <td>Manutenção</td>
                <td>Diarista</td>
                <td><span class="status inProgress">Disponivel</span></td>
            </tr>
            <tr>
                <td>Matheus Henrique</td>
                <td>Monitoria</td>
                <td>Mensalista</td>
                <td><span class="status return">Demitido</span></td>
            </tr>
            <tr>
                <td>Gustavo Henrique</td>
                <td>Monitoria</td>
                <td>Diarista</td>
                <td><span class="status pending">Fase de teste</span></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- New Customers -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Departamentos:</h2>
            <a href="<?= $router->route("web-department.new-department") ?>" class="btnDashbord">Novo</a>
        </div>
        <table>
            <?php
            $this->insert(
                "assets/fragments/department/registeredDepartments",
                ['departments' => $departments]
            );
            ?>
        </table>
    </div>


</div>