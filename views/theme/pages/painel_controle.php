<!--validar permissão (1)-->
<?php use Source\Controllers\Painel;

/** @var Painel $outputToday */
/** @var Painel $returnToday */
/** @var Painel $pendencies */
/** @var Painel $duePendencies */

$this->layout("theme/_themeDashboard");
?>
<!-- cards -->
<div class="cardBox">
    <div class="card pointer">
        <div>
            <div class="numbers">
                <?= $outputToday ?>
            </div>
            <div class="cardName">Retiradas Hoje</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-shopping-bags'></i>
        </div>
    </div>
    <div class="card pointer">
        <div>
            <div class="numbers">
                <?= $returnToday ?>
            </div>
            <div class="cardName">Devolvidos Hoje</div>
        </div>
        <div class="iconBx">
            <i class='bx bx-task'></i>
        </div>
    </div>
    <div class="card pointer">
        <div>
            <div class="numbers">
                <?= $pendencies ?>
            </div>
            <div class="cardName">Pendencias</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-analyse'></i>
        </div>
    </div>
    <div class="card pointer">
        <div>
            <div class="numbers">
                <?= $duePendencies ?>
            </div>
            <div class="cardName">Pendencias Vencidas</div>
        </div>
        <div class="iconBx">
            <i class='bx bxs-error-circle'></i>
        </div>
    </div>

</div>


<!-- TABLE SEARCH -->

<div class="details dw100" id="response">
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
</div>

<?php $this->start("scripts"); ?>
<script>
    $(function () {
        $(".pointer.card").on("click", function () {
            var reference = (this.getElementsByClassName("cardName")[0].textContent)

            if (this.classList.contains("card-filter-selected")) {
                this.classList.remove("card-filter-selected")
                reference = "Devolvidos Recentemente";
            } else {
                let list = document.querySelectorAll(".pointer.card-filter-selected")
                list.forEach((item) =>
                    item.classList.remove("card-filter-selected"))

                this.classList.add("card-filter-selected")


            }
            let list = document.querySelectorAll(".box-select-filter");
            list.forEach((item) =>
                item.classList.remove('box-select-filter-selected')
            )

            console.log(reference)

            $.ajax({
                type: 'POST',
                data: {reference: reference},
                url: '<?=$router->route("web-control.table_outputs")?>',
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $("#response").html(data.response)
                }
            })
        })

    })
</script>
<?php $this->end(); ?>
