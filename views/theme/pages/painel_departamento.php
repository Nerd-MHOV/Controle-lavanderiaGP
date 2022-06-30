<?php $this->layout("theme/_themeDashboard"); ?>
<div class="details">
    <!-- order details list-->
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Colaboradores:</h2>
            <div class="srcAndBtn">

                <!-- search -->
                <div class="searchRight">
                    <div class="search">
                        <label>
                            <input id="searchBar" type="text" placeholder="Buscar produto" />
                            <i class='bx bx-search'></i>
                        </label>
                    </div>
                </div>

                <a href=" <?=$router->route("web-department.new-collaborator") ?>" class="btnDashboard">Novo</a>
            </div>

        </div>
        <table>
            <thead>
            <tr>
                <td>Nome</td>
                <td>Departamento</td>
                <td>Tipo</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody id="bodyResponse">
            <?php
            $this->insert("assets/fragments/department/tableCollaborators", [
                    'collaborators' => $collaborators
            ])
            ?>
            </tbody>
        </table>
    </div>

    <!-- New Customers -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Departamentos:</h2>
            <a href="<?= $router->route("web-department.new-department") ?>" class="btnDashboard">Novo</a>
        </div>
        <table>
            <?php
            $this->insert(
                "assets/fragments/department/registeredDepartments",
                ['departments' => $departments]
            );
            ?>
        </table>
    </div>


</div>

    <!-- MODAL  -->
    <div id="myModal" class="modal">
        <?php
        $this->insert(
            "assets/fragments/department/modalCollaborator"
        )
        ?>
    </div>

<?php $this->start("scripts") ?>
    <script>
        $('#searchBar').keyup(function () {
            let search = $(this).val();
            $.ajax({
                url: "<?= $router->route("web-department.search_collaborators"); ?>",
                type: "post",
                data: {search: search},
                dataType: "json",
                success: function (callback) {
                    $("#bodyResponse").html(callback.response);
                }
            })
        });


        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        openModal = function (id) {


            $.ajax({
                type: 'POST',
                data: {id: id},
                url: '<?=$router->route("web-department.modal_collaborator")?>',
                dataType: 'json',
                beforeSend: function () {
                    ajax_load("open");
                },
                success: function (data) {
                    modal.style.display = "block";
                    $('#myModal').html(data.modal);
                },
                complete: function () {
                    ajax_load("close");
                }
            });

        }

        closeModal = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target === modal) {
                closeModal();
            }
        }

    </script>
<?php $this->end() ?>