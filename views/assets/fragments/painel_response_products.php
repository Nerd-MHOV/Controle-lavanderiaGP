<?php
if (!$id_collaborator): //SETOR
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
                <select class="selectClass" class="selectClass" name="select_productService[]" disabled id="select_productService-<?= $i ?>">
                    <option value="">Serviço</option>
                </select>
            </td>
            <td>
                <select class="selectClass" name="select_product[]" disabled id="select_product-<?= $i ?>">
                    <option value="">Produto</option>
                </select>
            </td>
            <td>
                <input name="amount[]" id="amount-<?=$i?>" type="number" min="1" disabled />
            </td>
        </tr>


        <script>
            $(".selectClass").select2({width: 'resolve'});

            $("#select_productType-<?=$i?>").on("change", function () {
                let select_productType = $(this).val();
                let select_productService = $("#select_productService-<?= $i ?>");
                let select_product = $("#select_product-<?= $i ?>");

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
                        select_product.prop("disabled", true);
                        if (callback.data.id_selectProductType) {
                            select_productService.html(callback.products);
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            })

            $("#select_productService-<?= $i ?>").on("change", function () {
                let select_productService = $(this).val();
                let select_productType = $("#select_productType-<?= $i ?>").val();
                let select_product = $("#select_product-<?= $i ?>");
                let nmb_amount = $("#amount-<?=$i?>");

                $.ajax({
                    type:"post",
                    url:"<?=$router->route("response.product_service")?>",
                    data: {
                        id_productType: select_productType,
                        id_productService: select_productService
                    },
                    dataType:"json",
                    beforeSend:function () {
                        ajax_load("open");
                    },
                    success: function (callback){
                        if (callback.data.id_productService) {
                            select_product.prop("disabled", false);
                            select_product.html(callback.products);
                            nmb_amount.prop("disabled", false);
                        } else {
                            select_product.prop("disabled", true);
                            nmb_amount.prop("disabled", true)
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            });
        </script>
    <?php
    endfor;
 else: //COLABORADOR
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
                <select class="selectClass" name="select_productService[]" disabled id="select_productService-<?= $i ?>">
                    <option value="">Serviço</option>
                </select>
            </td>
            <td>
                <select class="selectClass" name="select_product[]" disabled id="select_product-<?= $i ?>">
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
            $(".selectClass").select2({width: 'resolve'});

            $("#select_productType-<?=$i?>").on("change", function () {
                let select_productType = $(this).val();
                let select_productService = $("#select_productService-<?= $i ?>");
                let select_product = $("#select_product-<?= $i ?>");
                let select_status = $("#select_status-<?= $i ?>");

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
                        select_product.prop("disabled", true);
                        select_status.prop("disabled", true);
                        if (callback.data.id_selectProductType) {
                            select_productService.html(callback.products);
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            })

            $("#select_productService-<?= $i ?>").on("change", function () {
                let select_productService = $(this).val();
                let select_productType = $("#select_productType-<?= $i ?>").val();
                let select_product = $("#select_product-<?= $i ?>");
                let select_status = $("#select_status-<?= $i ?>");

                $.ajax({
                    type:"post",
                    url:"<?=$router->route("response.product_service")?>",
                    data: {
                        id_productType: select_productType,
                        id_productService: select_productService
                    },
                    dataType:"json",
                    beforeSend:function () {
                        ajax_load("open");
                    },
                    success: function (callback){
                        if (callback.data.id_productService) {
                            select_product.prop("disabled", false);
                            select_status.prop("disabled", false);
                            select_product.html(callback.products);
                        } else {
                            select_product.prop("disabled", true);
                            select_status.prop("disabled", true);
                        }
                    },
                    complete: function () {
                        ajax_load("close");
                    }
                })
            });

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
endif;
?>

