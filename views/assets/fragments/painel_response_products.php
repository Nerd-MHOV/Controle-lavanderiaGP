<?php $i = $countRow; ?>
<tr>
    <td>
        <select class="selectClass" name="select_productType[]" id="select_productType-<?= $i ?>">
            <option value="">Selecione o tipo</option>
            <?php
            $this->insert(
                "assets/fragments/painel_productType", [
                    "products" => $products
                ]
            );
            ?>
        </select>
    </td>
    <td>
        <select class="selectClass" name="select_productService[]" disabled
                id="select_productService-<?= $i ?>">
            <option value="">Serviço</option>
        </select>
    </td>
    <td>
        <select class="selectClass" name="select_product[]" disabled
                id="select_product-<?= $i ?>">
            <option value="">Produto</option>
        </select>
    </td>
    <td>
        <select class="selectClass" name="select_size[]" disabled
                id="select_size-<?= $i ?>">

        </select>
    </td>

    <?php
    if (!$id_collaborator): //SETOR
        ?>
        <td>
            <input name="amount[]" id="amount-<?= $i ?>" type="number" min="1" disabled/>
        </td>
    <?php
    else: //COLABORADOR
        $i = $countRow;
        ?>
        <td>
            <select class="selectClass" name="select_status[]" disabled id="select_status-<?= $i ?>">
                <option value="0">bom</option>
                <option value="1">ruim</option>
            </select>
        </td>
        <td>
            <textarea class="textarea-obs" name="txta_obs[]" data-idProduct="<?= $i ?>"
                      placeholder="descreva o defeito do item!" disabled id="txta_obs-<?= $i ?>"></textarea>
        </td>
    <?php
    endif;
    ?>

</tr>
<script>
    // SELECT 2
    $(".selectClass").select2({width: 'resolve'});


    // CHAMADAS
    if ($("#select_productType-<?= $i ?>").val() !== "") {
        opt_service("<?=$i?>");
    }
    $("#select_productType-<?=$i?>").on("change", function () {
        opt_service("<?=$i?>");
    })

    $("#select_productService-<?= $i ?>").on("change", function () {
        opt_product("<?=$i?>")
    });

    $('#select_product-<?= $i ?>').on("change", function () {
        opt_size("<?=$i?>")
    });

    $('#select_size-<?= $i ?>').on("change", function () {
        if ($(this).val() !== "") {
            $("#amount-<?= $i ?>").prop("disabled", false)
            $("#amount-<?= $i ?>").val("")
            $('#select_status-<?= $i ?>').prop("disabled", false)
        } else {
            $("#amount-<?= $i ?>").prop("disabled", true)
            $("#amount-<?= $i ?>").val("")
            $('#select_status-<?= $i ?>').prop("disabled", true)
        }
    })

    $("#select_status-<?=$i?>").on("change", function () {
        let select_status = $(this).val();
        let txta_obs = $("#txta_obs-<?=$i?>");
        if (select_status === "1") {
            txta_obs.prop("disabled", false);
        } else {
            txta_obs.prop("disabled", true);
        }
    });
</script>

