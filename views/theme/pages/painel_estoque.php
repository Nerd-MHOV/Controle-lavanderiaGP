<!--validar permissão (1)-->
<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader">
        <h2>Itens em estoque</h2>
        <!-- search -->
        <div class="search">
            <label>
                <input type="text" placeholder="Buscar produto">
                <i class='bx bx-search'></i>
                <!--<img style="width: 100%; max-width:200px" src="<?= asset("images/GrupoperaltasCompleto.png") ?>" alt="LogoCompleta">-->
            </label>
        </div>
    </div>
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Produto</th>
                <th>Oficio</th>
                <th>Departamento</th>
                <th>Estoque</th>
                <th>Pendente</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($products)):
                foreach ($products as $product):
                    ?>
                    <tr>
                        <td><?= $product->productType()->product_type ?></td>
                        <td><?= $product->product ?></td>
                        <td><?= $product->productService()->service ?></td>
                        <td><?= $product->department()->department ?></td>
                        <td><?= $product->inInventory() ?></td>
                        <td><?= $product->inOutput() ?></td>
                        <td><?= $product->amountOutInv()?></td>
                    </tr>
                <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
