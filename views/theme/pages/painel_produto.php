<?php $this->layout("theme/_themeDashboard");

use Source\Controllers\Painel;

/** @var Painel $router */
/** @var Painel::produto $products */
?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader">
        <h2>Produtos Cadastrados</h2>
        <div>
            <a href="<?= $router->route("web-product.new-type"); ?>" class="btnDashboard">Novo tipo</a>
            <a href="<?= $router->route("web-product.new-service"); ?>" class="btnDashboard">Novo oficio</a>
            <a href="<?= $router->route("web-product.new-product"); ?>" class="btnDashboard">Novo produto</a>
        </div>
    </div>

    <!-- search -->
    <div class="searchRight">
        <div class="search">
            <label>
                <input id="searchBar" type="text" placeholder="Buscar produto" />
                <i class='bx bx-search'></i>
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
                <th>Tamanho</th>
                <th>Valor por Unidade</th>
                <th>Departamento</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="bodyResponse">
            <?php
            if (!empty($products)):
                foreach ($products as $product):
                    ?>
                    <tr>
                        <td><?= $product->productType()->product_type ?></td>
                        <td><?= $product->product ?></td>
                        <td><?= $product->productService()->service ?></td>
                        <td><?= $product->size ?></td>
                        <td><?= $product->unitary_value ?></td>
                        <td><?= $product->department()->department ?></td>
                        <?php
                        if ($product->status == "A"):
                            echo "<td><span class=\"status delivered\">Ativo</span></td>";
                        elseif ($product->status == "D"):
                            echo "<td><span class=\"status return\">Desativado</span></td>";
                        endif;
                        ?>
                    </tr>
                <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->start("scripts") ?>
    <script>
        $('#searchBar').keyup(function () {
            let search = $(this).val();
            $.ajax({
                url: "<?= $router->route("web-product.search-products"); ?>",
                type: "post",
                data: {search: search},
                dataType: "json",
                success: function (callback) {
                    $("#bodyResponse").html(callback.response);
                }
            })
        });
    </script>
<?php $this->end() ?>