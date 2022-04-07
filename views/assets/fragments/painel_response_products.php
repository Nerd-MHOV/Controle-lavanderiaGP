<?php
if (!$id_collaborator) { //SETOR
    for ($i = 0; $i < $countRow; $i++):
        ?>
        <tr>
            <td>
                <select name="select_productType[]" id="select_productType-<?= $i ?>">
                    <option value="">Selecione o tipo</option>
                    <?php
                    $this->insert(
                        "assets/fragments/painel_productType",
                        ["products" => $products]
                    );
                    ?>
                </select>
            </td>
            <td>
                <select name="select_product[]" disabled id="select_product-<?= $i ?>">
                    <option value="">Produto</option>
                </select>
            </td>
            <td>
                <input name="amount[]" id="amount-<?=$i?>" type="number" min="1" disabled />
            </td>
        </tr>


        <script>
            $("#select_productType-<?=$i?>").on("change", function () {
                let select_productType = $(this).val();
                let select_product = $("#select_product-<?=$i?>");
                let amount = $("#amount-<?=$i?>");
                let damaged = $("#damaged-<?=$i?>");

                $.ajax({
                    type: "POST",
                    url: "<?=$router->route("response.typeproducts")?>",
                    data: {
                        id_selectProductType: select_productType
                    },
                    dataType: "json",
                    beforeSend: function () {
                        ajax_load("open");
                    },
                    success: function (callback) {
                        console.log(callback);
                        select_product.prop("disabled", false);
                        amount.prop("disabled", false);
                        damaged.prop("disabled", false);
                        if (callback.data.id_selectProductType) {
                            select_product.html(callback.products);
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            })

            $("#select_status-<?=$i?>").on("change", function () {
                let select_status = $(this).val();
                let txta_obs = $("#txta_obs-<?=$i?>");
                if (select_status === "ruim") {
                    txta_obs.prop("disabled", false);
                } else {
                    txta_obs.prop("disabled", true);
                }
            });
        </script>
    <?php
    endfor;
} else { //COLABORADOR
    for ($i = 0; $i < $countRow; $i++):
        ?>
        <tr>
            <td>
                <select class="selectClass" name="select_productType[]" id="select_productType-<?= $i ?>">
                    <option value="">Selecione o tipo</option>
                    <?php
                    $this->insert(
                        "assets/fragments/painel_productType",
                        ["products" => $products]
                    );
                    ?>
                </select>
            </td>
            <td>
                <select name="select_productService[]" disabled id="select_productService-<?= $i ?>">
                    <option value="">Serviço</option>
                </select>
            </td>
            <td>
                <select name="select_product[]" disabled id="select_product-<?= $i ?>">
                    <option value="">Produto</option>
                </select>
            </td>
            <td>
                <select name="select_status[]" disabled id="select_status-<?= $i ?>">
                    <option value="bom">bom</option>
                    <option value="ruim">ruim</option>
                </select>
            </td>
            <td>
            <textarea class="textarea-obs" name="txta_obs[]" data-idProduct="<?= $i ?>"
                      placeholder="descreva o defeito do item!" disabled id="txta_obs-<?= $i ?>"></textarea>
            </td>
        </tr>


        <script>
            $(".selectClass").select2();
            $("#select_productType-<?=$i?>").on("change", function () {
                let select_productType = $(this).val();
                let select_productService = $("#select_productService-<?= $i ?>");
                $.ajax({
                    type: "POST",
                    url: "<?=$router->route("response.typeproducts")?>",
                    data: {
                        id_selectProductType: select_productType
                    },
                    dataType: "json",
                    beforeSend: function () {
                        ajax_load("open");
                    },
                    success: function (callback) {
                        console.log(callback);
                        select_productService.prop("disabled", false);
                        if (callback.data.id_selectProductType) {
                            select_product.html(callback.products);
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            })

            $("#select_status-<?=$i?>").on("change", function () {
                let select_status = $(this).val();
                let txta_obs = $("#txta_obs-<?=$i?>");
                if (select_status === "ruim") {
                    txta_obs.prop("disabled", false);
                } else {
                    txta_obs.prop("disabled", true);
                }
            });
        </script>
    <?php
    endfor;
}
?>

