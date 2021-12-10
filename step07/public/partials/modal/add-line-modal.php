<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<div class="modal fade" id="addLineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content admin-modal">
            <div class="modal-header admin-modal_header">
            <h5 class="modal-title" id="exampleModalLabel">Add line</h5>
            <button type="button" class="green_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body admin-modal-content">
                <label for="name">Type</label>
                <input class="form-control" type="text" id="name" name="name">
            </div>
            <div class="admin-modal_footer modal-footer">
            <button type="button" class="green_button" id="add-line-button" data-bs-dismiss="modal" aria-label="Close">Add new line</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#add-line-button').click(function() {
            $.ajax({
                method: "post",
                url: "../public/ajax/setObject.ajax.php",
                dataType: "json",
                data  :  {
                    'objet' : 'Type',
                    'propriete' : {
                        'label' : $('#name').val()
                    }
                }
            })
            .done(function(response){
                console.log(response)
            })
            .fail(function() {
                console.log("error")
            })
        })
    });
</script>