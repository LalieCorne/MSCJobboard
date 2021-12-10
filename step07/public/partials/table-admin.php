<div class="card">
    <div class="card-body">
        <h5 class="card-title" id="table-title"></h5>
        <div class="position-absolute top-0 end-0">
            <button id='plus-button' class="green_button" type="button" data-bs-toggle="modal" data-bs-target="#addLineModal">
                <img class="img"
                    src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/002-plus.png"
                    alt="Plus button">
            </button>

            <?php include(_ROOT_DIR_."/partials/modal/add-line-modal.php")
            ?>

            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    var myModal = document.getElementById('addLineModal')
                    var myInput = document.getElementById('plus-button')
                    myModal.addEventListener('shown.bs.modal', function () {
                        myInput.focus()
                    })
                });
            </script>
        </div>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                    <td>
                        <button class="green_button" id="modify-button" type="button" data-bs-toggle="modal" data-bs-target="#modifyModal">
                            <img class="img"
                                src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/003-edit-button.png"
                                alt="Modify button">
                        </button>

                        <?php include(_ROOT_DIR_."/partials/modal/modify-modal.php")
                        ?>

                        <script>
                            document.addEventListener('DOMContentLoaded', function(){
                                var myModal = document.getElementById('modifyModal')
                                var myInput = document.getElementById('modify-button')
                                myModal.addEventListener('shown.bs.modal', function () {
                                    myInput.focus()
                                })
                            });
                        </script>
                        <button class="green_button"id="delete-button" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <img class="img"
                                src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/001-delete.png"
                                alt="Delete button">
                        </button>

                        <?php include(_ROOT_DIR_."/partials/modal/delete-modal.php")
                        ?>

                        <script>
                            document.addEventListener('DOMContentLoaded', function(){
                                var myModal = document.getElementById('deleteModal')
                                var myInput = document.getElementById('delete-button')
                                myModal.addEventListener('shown.bs.modal', function () {
                                    myInput.focus()
                                })
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                    <td>
                        <button class="green_button">
                            <img class="img"
                                src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/003-edit-button.png"
                                alt="Modify button">
                        </button>
                        <button class="green_button">
                            <img class="img"
                                src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/001-delete.png"
                                alt="Delete button">
                        </button>
                    </td>
                </tr>
            </tbody>
        </table> 
    </div>
</div>