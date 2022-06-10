<!--validar permissão (1)-->
<?php use Source\Controllers\Painel;

/** @var Painel $outputToday */
/** @var Painel $returnToday */
/** @var Painel $pendencies */
/** @var Painel $duePendencies */

$this->layout("theme/_themeDashboard");
?>
<!-- cards -->
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers">
                <?= $outputToday ?>
            </div>
            <div class="cardName">Retiradas Hoje</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-shopping-bags'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">
                <?= $returnToday ?>
            </div>
            <div class="cardName">Devolvidos Hoje</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-task'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">
                <?= $pendencies ?>
            </div>
            <div class="cardName">Pendecias</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-analyse'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">
                <?= $duePendencies ?>
            </div>
            <div class="cardName">Pendecias Vencidas</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-error-circle'></i>
        </div>
    </div>

</div>


<!-- Pendencies -->

    <div class="details dw100">
        <!-- order details list-->
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Devolvidos Recentemente</h2>
                <!-- search -->
                <div class="search">
                    <label>
                        <input id="searchBar" type="text" placeholder="Buscar">
                        <i class='bx bx-search'></i>
                    </label>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <td>Colaborador</td>
                    <td>Departamento</td>
                    <td>Tipo</td>
                    <td>Produto</td>
                    <td>Oficio</td>
                    <td>Tamanho</td>
                    <td>Retirado</td>
                    <td>Devolvido</td>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
</div>
