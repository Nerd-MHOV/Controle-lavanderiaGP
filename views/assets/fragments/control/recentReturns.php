<!-- order details list-->
<div class="recentOrders">
    <div class="cardHeader">
        <h2>Devolvidos Recentemente</h2>

    </div>
    <table>
        <thead>
        <tr>
            <td>Colaborador</td>
            <td>Departamento</td>
            <td>Tipo</td>
            <td>Produto</td>
            <td>Oficio</td>
            <td>Tamanho</td>
            <td>Quantidade</td>
            <td>Retirado</td>
            <td>Devolvido</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($recents)):
            foreach ($recents as $recent):
                ?>
                <tr>
                    <td><?= $recent->collaborator()->collaborator ?></td>
                    <td><?= $recent->department()->department ?></td>
                    <td><?= $recent->productType()->product_type ?></td>
                    <td><?= $recent->product()->product ?></td>
                    <td><?= $recent->productService()->service ?></td>
                    <td><?= $recent->product()->size ?></td>
                    <td><?= $recent->amount ?></td>
                    <td><?= date("d/m H:i", strtotime($recent->date_in)) ?></td>
                    <td><?= date("d/m H:i", strtotime($recent->date_out)) ?></td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
</div>