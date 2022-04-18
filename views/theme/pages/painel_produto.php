<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader">
        <h2>Produtos Cadastrados</h2>
        <div>
            <a href="<?= $router->route("painel.cadastrar_productType"); ?>" class="btnDashbord">Novo tipo</a>
            <a href="<?= $router->route("painel.cadastrar_productService"); ?>" class="btnDashbord">Novo oficio</a>
            <a href="<?= $router->route("painel.cadastrar_product"); ?>" class="btnDashbord">Novo produto</a>
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
                <td><?=$product->productType()->product_type?></td>
                <td><?=$product->product?></td>
                <td><?=$product->productService()->service?></td>
                <td><?=$product->unitary_value?></td>
                <td><?=$product->department()->department?></td>
                <?php
                    if($product->status == "A"):
                        echo "<td><span class=\"status delivered\">Ativo</span></td>";
                    elseif($product->status == "D"):
                        echo "<td><span class=\"status return\">Desativado</span></td>";
                    endif;
                ?>

            </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>