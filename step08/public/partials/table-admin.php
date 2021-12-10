<div class="card" id="card-table">
    <div class="card-body">
        <h5 class="card-title" id="table-title"></h5>
        <div class="position-absolute top-0 end-0">
            <button id='plus-button' class="green_button" type="button" data-bs-toggle="modal" data-bs-target="#addLineModal">
                <img class="img"
                    src="<?=_ROOT_URL_?>/public/assets/img/icon/svg/002-plus.png"
                    alt="Plus button">
            </button>
        </div>
        <div class="table-responsive dataTables_wrapper">
            <table id="table_id" class="display table table-striped">
                <thead class="w-100">
                    <tr id='table-head-tr'>
                        <th id="th-1">Col 1</th>
                        <th id="th-2">Col 2</th>
                        <th id="th-3">Col 3</th>
                        <th id="th-4"></th>
                    </tr>
                </thead>
                <tbody class="w-100">
                </tbody>
            </table> 
        </div>
    </div>
</div>