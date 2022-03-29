<?php
for ($i = 0; $i < $countRow; $i++):
    ?>
    <tr>
        <td>
            <select name="tipo_produto">
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
            <select name="produto" disabled>
                <option value="">Produto</option>
            </select>
        </td>
        <td>
            <select name="estado" disabled>
                <option value="bom">Estado</option>
            </select>
        </td>
        <td>
            <textarea class="textarea-obs" name="observação" placeholder="descreva o defeito do item!"
                      disabled></textarea>
        </td>
    </tr>
<?php
endfor;
?>