<form method="post" class="" action="<?=$router->route("response.return_product")?>">
    <div id="modalphp" class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Devolver <u><?=$productName?></u> <i style="color: #cecece; font-size: 16px">maximo <?=$totalAmount?></i></h3>



        <div class="modal-wrapper modal-setor">
            <div class="modal-setor-single">
                <div class="modal-single">
                    <h5>Qtde de itens bons:</h5>
                    <input style="color: green" name="numx" type="number" id="numx" value="<?=$totalAmount?>" min="0" max="<?= $totalAmount ?>">
                </div>
                <div class="modal-single">
                    <h5>Qtde de danificadas:</h5>
                    <input style="color: red" name="numy" type="number" id="numy" value="0" min="0" max="0">
                </div>
            </div>

            <div class="textarea">
                <textarea placeholder="Descrição necessaria, quando o estado for 'Ruim'" name="obs-modal" id="txta-obsModal" maxlength="255" disabled></textarea>
            </div>
        </div>

        <div class="modal-buttom">
            <input type="hidden" name="id_saida" value="<?=$id_saida?>">
            <input type="hidden" name="total" value="<?=$totalAmount?>">
            <input class="ignoreClass" type="submit" name="devolver-setor" value="Devolver">
        </div>

    </div>
</form>

<script>
    $('#numx').change(function(){
        maxValue = <?=$totalAmount?>;
        xvalue = $(this).val();
        yvalue = $('#numy').val();
        xmax = maxValue - yvalue;
        ymax = maxValue - xvalue;
        $(this).attr('max', xmax)
        $('#numy').attr('max', ymax)
    })
    $('#numy').change(function(){
        maxValue = <?=$totalAmount?>;
        yvalue = $(this).val();
        xvalue = $('#numx').val();
        ymax = maxValue - xvalue;
        xmax = maxValue - yvalue;
        $(this).attr('max', ymax)
        $('#numx').attr('max', xmax)

        if(yvalue === "0"){
            $("#txta-obsModal").prop("disabled", true);
        }else{
            $("#txta-obsModal").prop("disabled", false);
        }
    })
</script>