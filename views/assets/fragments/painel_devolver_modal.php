<form method="post" action="<?=$router->route("response.return_product")?>">
    <div id="modalphp" class="modal-content">

        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3><?=$productName?>:</h3>



        <div class="modal-wrapper">
            <div class="modal-single">
                <h5>Estado quando Recebido:</h5>
                <select disabled class="ignoreClass" >
                    <option><?=$status_old?></option>
                </select>

                <textarea disabled><?=$obs_old?></textarea>
            </div>

            <div class="modal-icon">
                <i class='bx bxs-right-arrow-circle'></i>
            </div>

            <div class="modal-single">
                <h5>Estado quando Devolvido:</h5>
                <select class="ignoreClass" name="estado-modal" id="status_new" required>
                    <option></option>
                    <?php if($status_old == "bom"): ?>
                    <option>bom</option>
                    <?php endif; ?>
                    <option>ruim</option>
                </select>

                <textarea placeholder="Descrição necessaria, quando o estado for 'Ruim'" name="obs-modal" id="obs_new" maxlength="255" required disabled></textarea>
            </div>



        </div>

        <div class="modal-buttom">
            <input type="hidden" name="productName" value="<?=$productName?>">
            <input type="hidden" name="id_saida" value="<?=$id_saida?>">
            <input type="submit" name="devolver" value="Devolver">
        </div>

    </div>
</form>

<script src="<?=asset("js/form.js")?>"></script>
<script>
    $("#status_new").on("change", function(){
        let status = $(this).val();
        if (status === "ruim") {
            $("#obs_new").prop("disabled", false);
        } else {
            $("#obs_new").prop("disabled", true);
        }
    });
</script>