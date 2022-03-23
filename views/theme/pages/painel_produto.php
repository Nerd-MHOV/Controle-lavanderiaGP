<!--validar permissão (1)-->
<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader">
        <h2>Produtos Cadastrados</h2>
        <div>
            <a href="<?= $router->route("painel.produto_cadastrar_painel"); ?>" class="btnDashbord">Novo tipo</a>
            <a href="<?= $router->route("painel.produto_cadastrar"); ?>" class="btnDashbord">Novo produto</a>
        </div>
    </div>
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th colspan="2">Produto</th>
                <th>Valor por Unidade</th>
                <th>Departamento</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>R$ 10,00</td>
                <td>Monitoria</td>
                <td><span class="status delivered">Ativo</span></td>
            </tr>
            <tr>
                <td>Camiseta</td>
                <td>Verde</td>
                <td>R$ 15,00</td>
                <td>Monitoria</td>
                <td><span class="status pending">Desativada</span></td>
            </tr>
            <tr>
                <td>Camiseta</td>
                <td>Amarela</td>
                <td>R$ 10,00</td>
                <td>Monitoria</td>
                <td><span class="status delivered">Ativo</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>