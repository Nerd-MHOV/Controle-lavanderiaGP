<form method="post" class="" action="<?=$router->route("web-return.return_product")?>">
    <div id="modalphp" class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Devolver <u><?=$productName?></u> <i style="color: #cecece; font-size: 16px">maximo <?=$totalAmount?></i></h3>

        <div class="login_form_callback center20px">
            <?= flash(); ?>
        </div>


        <div class="modal-wrapper modal-setor">
            <div class="modal-setor-single">
                <div class="modal-single">
                    <h5>Qtde de itens bons:</h5>
                    <input style="color: green" name="nmb_good" type="number" id="numx" value="<?=$totalAmount?>" min="0" max="<?= $totalAmount ?>">
                </div>
                <div class="modal-single">
                    <h5>Qtde de danificadas:</h5>
                    <input style="color: red" name="nmb_bad" type="number" id="numy" value="0" min="0" max="0">
                </div>
            </div>

            <div class="modalContent">
                <div class="responsibleReturnBox">
                    <h5>retirado por:</h5>
                    <div class="responsibleReturnSingle">
                        <select class="selectClass" name="" id="" disabled>
                            <option value=""><?=$responsible_in?></option>
                        </select>
                    </div>
                    <h5>devolvido por:</h5>
                    <div class="responsibleReturnSingle">
                        <select class="selectClass" name="responsible_out" id="responsible_out" data-placeholder="Selecione quem devolveu">
                            <option value=""></option>
                            <?php
                            if (!empty($responsibles)):
                                foreach ($responsibles as $responsible):
                                    ?>
                                    <option value="<?= $responsible->id  ?>" ><?= $responsible->collaborator ?></option>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="textarea">
                    <textarea placeholder="Descrição necessaria, quando o estado for 'Ruim'" name="obs-modal" id="txta-obsModal" maxlength="255" disabled></textarea>
                </div>
            </div>
        </div>

        <div class="modal-buttom">
            <input type="hidden" name="productName" value="<?=$productName?>">
            <input type="hidden" name="id_saida" value="<?=$id_saida?>">
            <input type="hidden" name="total" value="<?=$totalAmount?>">
            <input class="ignoreClass" type="submit" name="devolver-setor" value="Devolver">
        </div>

    </div>
</form>

<script src="<?=asset("js/form.js")?>"></script>
<script>
    $(".selectClass").select2();
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