<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content admin-modal">
        <div class="modal-header admin-modal_header">
        <h5 class="modal-title" id="exampleModalLabel">Modifications</h5>
        <button type="button" class="green_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body admin-modal-content">
            <label for="name">Type</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="modal-footer admin-modal_footer">
        <button type="button" class="green_button" data-bs-dismiss="modal" aria-label="Close">Approuved modifications</button>
        </div>
    </div>
    </div>
</div>