<!--validar permissão (1)-->
<?php $this->layout("theme/_themeDashbord"); ?>
<!-- cards -->
<div class="cardBox cardBox_retirar">
    <div class="card">
        <div>
            <div class="numbers">Departamento</div>
            <div class="cardName">
                <select name="departamento">
                    <option value="">Monitoria</option>
                    <option value="">Monitoria</option>
                    <option value="">Monitoria</option>
                    <option value="">Monitoria</option>
                </select>
            </div>
        </div>
        <div class="iconBx iconBx_retirar">
            <i class='bx bxs-hard-hat'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">Colaborador</div>
            <div class="cardName">
                <select name="colaborador">
                    <option value="">Matheus Henrique</option>
                    <option value="">Matheus Henrique</option>
                    <option value="">Matheus Henrique</option>
                    <option value="">Matheus Henrique</option>
                </select>
            </div>
        </div>
        <div class="iconBx">
            <i class='bx bx-user'></i>
        </div>
    </div>
    <div class="card">
        <div>
            <div class="numbers">Qtde de retiradas</div>
            <div class="cardName">
                <input type="number" name="qtde_itens" value="1" min="1" />
            </div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-backpack'></i>
        </div>
    </div>
</div>

<div class="containerPainel">
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th></th>
                <th colspan="2">Produto</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Item 01:</td>
                <td>
                    <select name="tipo_produto">
                        <option value="">Toalha</option>
                    </select>
                </td>
                <td>
                    <select name="produto">
                        <option value="">Amarela - Brotas Eco</option>
                    </select>
                </td>
                <td>
                    <select name="estado">
                        <option value="bom">bom</option>
                        <option value="ruim">ruim</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>OBS Item 01:</td>
                <td colspan="3"><textarea class="textarea-obs" name="observação" placeholder="descreva o defeito do item!"></textarea></td>
            </tr>
            <tr>
                <td>Item 02:</td>
                <td>
                    <select name="tipo_produto">
                        <option value="">Cobertor</option>
                    </select>
                </td>
                <td>
                    <select name="produto">
                        <option value="">Amarela - Brotas Eco</option>
                    </select>
                </td>
                <td>
                    <select name="estado">
                        <option value="bom">bom</option>
                        <option value="ruim">ruim</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>