<style>
    * {
        padding: 0;
        margin: 10px;
        box-sizing: border-box;
        font-family: 'Open Sans', sans-serif;
    }

    .center {
        max-width: 1280px;
        padding: 0 2%;
        margin: 0 auto;
    }

    h1, h2, h3 {
        margin: 20px 0;
        text-align: center;
    }

    ul {
        margin-top: -12px;
        margin-left: 30px;
    }

    p {
        margin: 15px 0;
    }

    table {
        text-align: center;
        align-items: center;
        max-width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
        border: 2px solid black;
    }

    td, th {
        font-size: 10px;
        padding: 8px;
        border: 1px solid black;
    }
</style>
<div class="center">
    <div class="documento">
        <h2>TERMO DE RESPONSABILIDADE</h2>
        <p>Eu <b><?=$collaborator->collaborator?></b>, portador do C.P.F: <b><?=$collaborator->cpf?></b>, declaro estar ciente de que todos os uniformes
            especificados e entregues nesta ficha foram disponibilizados gratuitamente para exercício da minha função,
            sendo os mesmo de exclusiva propriedade do Grupo Peraltas, bem como a obrigatoriedade de seu uso durante
            minhas atividades, comprometendo-me assim a respeitar e cumprir o que segue abaixo:</p>

        <p>1º - Fazer uso do uniforme, abstendo-me de usá-lo para fins extra-profissionais;</p>
        <p>2º - Zelar pela boa conservação destes</p>
        <p>3º - A restitui-los, repondo o mesmo ou seu valor correspondente. Nos seguintes casos:</p>
        <ul>
            <li>Na eventualidade de me afastar do emprego definitivamente;</li>
            <li>Estar sob posse do uniforme por mais de <b>03 dias</b>;</li>
            <li>No caso de extravio ou qualquer danos oriundos de mau uso ou falta de cuidado para com eles;</li>
            <li>Na substituição por outro, depois de ter feito o devido uso.</li>
        </ul>
    </div>
    <br>
    <h3>RELAÇÃO DOS UNIFORMES ENTREGUES:</h3>

    <table>
        <tr>
            <th>Departamento</th>
            <th>Quantidade</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Produto</th>
            <th>Oficio</th>
            <th>Tamanho</th>
            <th>Valor unitario</th>
            <th>Retirado em:</th>
            <th>Devolvido em:</th>
            <th>Obs:</th>
        </tr>
        <?php
        foreach ($outputs as $output):
            ?>
            <tr>
                <td><?=$output->department()->department?></td>
                <td><?=$output->amount?></td>
                <td><?=$output->status?></td>
                <td><?=$output->productType()->product_type?></td>
                <td><?=$output->product()->product?></td>
                <td><?=$output->productService()->service?></td>
                <td><?=$output->product()->size?></td>
                <td><?=$output->product()->unitary_value?></td>
                <td><?=date("d/m H:i", strtotime($output->created_at))?></td>
                <td></td>
                <td style="font-size: 10px"><?=$output->obs?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>

    <br>
    <p style="text-align: right;">Brotas-SP - <?= utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today'))); ?>
        <br>
        <para style="font-size: 10px;"> Emitido por: <?=$issuer?></para>
    </p>
    <br>
    <br>
    <p style="text-align: right;">________________________________</p>
    <p style="text-align: right; margin-top: -15px;">Assinatura do Colaborador</p>

</div>