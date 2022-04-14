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
                <th colspan="3">Produto</th>
                <th>Valor por Unidade</th>
                <th>Departamento</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($products as $product):
            ?>
            <tr>
                <td>Camiseta</td>
                <td><?=$product->product?></td>
                <td>brotas eco</td>
                <td>R$ 10,00</td>
                <td>Monitoria</td>
                <td><span class="status delivered">Ativo</span></td>
            </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>