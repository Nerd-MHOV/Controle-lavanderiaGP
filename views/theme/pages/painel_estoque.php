<!--validar permissão (1)-->
<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader">
        <h2>Itens em estoque</h2>
        <!-- search -->
        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <i class='bx bx-search'></i>
                <!--<img style="width: 100%; max-width:200px" src="<?=asset("images/GrupoperaltasCompleto.png")?>" alt="LogoCompleta">-->
            </label>
        </div>
    </div>
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th colspan="2">Produto</th>
                <th>Departamento</th>
                <th>Estoque</th>
                <th>Pendente</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>Monitoria</td>
                <td>15</td>
                <td>15</td>
                <td>30</td>
            </tr>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>Monitoria</td>
                <td>15</td>
                <td>15</td>
                <td>30</td>
            </tr>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>Monitoria</td>
                <td>15</td>
                <td>15</td>
                <td>30</td>
            </tr>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>Monitoria</td>
                <td>15</td>
                <td>15</td>
                <td>30</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
