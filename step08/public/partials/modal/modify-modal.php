<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content admin-modal">
        <div class="modal-header admin-modal_header">
        <h5 class="modal-title" id="exampleModalLabel">Modifications</h5>
        <button type="button" class="green_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body admin-modal-content">
            <input type="text" id="id_sector" name="id" hidden>

            <label for="nameModify">Type</label>
            <input class="form-control" type="text" id="nameModify" name="name">
            </div>
        <div class="modal-footer admin-modal_footer">
        <button id="modify-line-button" type="button" class="green_button" data-bs-dismiss="modal" aria-label="Close">Approuved modifications</button>
        </div>
    </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        $('#modify-line-button').click(function() {
            if($('#nameModify').val() != '' && $('#nameModify').val() != null){
                $.ajax({
                    type: "post",
                    url: "http://127.0.0.1:3000/api/sector/update.php",
                    dataType: "json",
                    data  :  JSON.stringify({
                        "id_sector" : $('#modifyModal #id_sector').val(),
                        "label" : $('#nameModify').val()
                    })
                })
                .done(function(response){
                    console.log(response)
                })
                .fail(function() {
                    console.log("error")
                })
            }
            
        })
    });
</script>
