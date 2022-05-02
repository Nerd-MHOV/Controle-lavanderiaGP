<?php $this->layout("theme/_themeDashboard"); ?>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>
            <a href=" <?=$router->route("web-department.new-collaborator") ?>" class="btnDashboard">Novo</a>
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
            <?php
            $this->insert("assets/fragments/department/tableCollaborators", [
                    'collaborators' => $collaborators
            ])
            ?>
            </tbody>
        </table>
    </div>

    <!-- New Customers -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Departamentos:</h2>
            <a href="<?= $router->route("web-department.new-department") ?>" class="btnDashboard">Novo</a>
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