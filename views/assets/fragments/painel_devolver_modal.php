<form method="post">
    <div id="modalphp" class="modal-content">

        <span class="close-btn">&times;</span>
        <h3>Devolver "Toalha Amarela":</h3>



        <div class="modal-wrapper">
            <div class="modal-single">
                <h5>Estado quando Recebido:</h5>
                <select disabled class="ignoreClass" >
                    <option></option>
                </select>

                <textarea disabled></textarea>
            </div>

            <div class="modal-icon">
                <i class='bx bxs-right-arrow-circle'></i>
            </div>

            <div class="modal-single">
                <h5>Estado quando Devolvido:</h5>
                <select class="ignoreClass" name="estado-modal" required>
                     <option></option>
                     <option>bom</option>
                    <option>ruim</option>
                </select>

                <textarea placeholder="Descrição necessaria, quando o estado for 'Ruim'" name="obs-modal" maxlength="255"></textarea>
            </div>



        </div>

        <div class="modal-buttom">
            <input type="hidden" name="id_saida" value="">
            <input class="ignoreClass" onclick="span.onclick()" type="submit" name="cancelar" value="Cancelar">
            <input class="ignoreClass" type="submit" name="devolver" value="Devolver">
        </div>

    </div>
</form>