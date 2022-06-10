<?php $this->layout("theme/_themeDashboard");

use Source\Controllers\Painel;

/** @var Painel $collaborator */
/** @var Painel $router */
?>
<!-- cards -->
<div class="containerPainel">
    <div class="cardHeader" style="margin-bottom: 10px">
        <h2>Danificados por colaborador</h2>
        <!-- search -->
        <div class="search">
            <label>
                <input id="searchBar" type="text" placeholder="Buscar">
                <i class='bx bx-search'></i>
                <!--<img style="width: 100%; max-width:200px" src="<?= asset("images/GrupoperaltasCompleto.png") ?>" alt="LogoCompleta">-->
            </label>
        </div>
    </div>
    <div class="tablePainel">
        <table>
            <thead>
            <tr>
                <th>Colaborador</th>
                <th>Departamento</th>
                <th>Pendencias</th>
                <th>Detalhes...</th>
            </tr>
            </thead>
            <tbody id="bodyResponse">
            <?php
            if (!empty($collaborator)):
                foreach ($collaborator as $collab):
                    ?>
                    <tr>
                        <td><?= $collab->collaborator ?></td>
                        <td><?= $collab->department() ?></td>
                        <td><?= $collab->amountPendencies() ?></td>
                        <td><span class="status inProgress" onclick="openModal(<?=$collab->id?>)" style="cursor: pointer;">Ver mais!</span></td>
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
            url: "<?= $router->route("web-iventory.search-iventory"); ?>",
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
