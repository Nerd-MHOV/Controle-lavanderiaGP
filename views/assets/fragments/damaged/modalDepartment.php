<form method="post" class="" action="<?=$router->route("response.return_product")?>">
    <div id="modalphp" class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Devolver <u><?=$productName?></u></h3>



        <div class="modal-wrapper modal-setor">
            <div class="modal-setor-single">
                <div class="modal-single">
                    <h5>Qtde de itens bons:</h5>
                    <input style="color: green" name="nmb_good" type="number" id="numx" value="<?=$amountGood?>" disabled>
                </div>
                <div class="modal-single">
                    <h5>Qtde de danificadas:</h5>
                    <input style="color: red" name="nmb_bad" type="number" id="numy" value="<?=$amountBad?>" disabled>
                </div>
            </div>

            <div class="textarea">
                <textarea placeholder="Descrição necessaria, quando o estado for 'Ruim'" name="obs-modal" id="txta-obsModal" disabled><?=$obs_out?></textarea>
            </div>
        </div>
    </div>
</form>