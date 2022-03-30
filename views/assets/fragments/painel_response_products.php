<?php
for ($i = 0; $i < $countRow; $i++):
    ?>
    <tr>
        <td>
            <select name="tipo_produto" id="select_productType-<?=$i?>">
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
            <select name="produto" disabled id="select_product-<?=$i?>">
                <option value="">Produto</option>
            </select>
        </td>
        <td>
            <select name="estado" disabled id="select_status-<?=$i?>">
                <option value="bom">bom</option>
                <option value="ruim">ruim</option>
            </select>
        </td>
        <td>
            <textarea class="textarea-obs" name="observação" placeholder="descreva o defeito do item!"
                      disabled id="txta_obs-<?=$i?>"></textarea>
        </td>
    </tr>


    <script>
        $("#select_productType-<?=$i?>").on("change", function(){
            let select_productType = $(this).val();
            let select_product = $("#select_product-<?=$i?>");
            let select_status = $("#select_status-<?=$i?>");
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
                success: function(callback){
                    console.log(callback);
                    select_product.prop("disabled", false);
                    select_status.prop("disabled", false);
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
           if(select_status === "ruim"){
               txta_obs.prop("disabled", false);
           }else{
               txta_obs.prop("disabled", true);
           }
        });
    </script>
<?php
endfor;
?>

