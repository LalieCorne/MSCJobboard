<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content admin-modal">
        <div class="modal-header admin-modal_header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="green_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body admin-modal-content">
            <p>Are sure you want to delete this line ?<p>
        </div>
        <input type="text" id="id_sector" hidden>
        <div class="modal-footer admin-modal_footer">
        <button id="delete-line-button" type="button" class="green_button" data-bs-dismiss="modal" aria-label="Close">Yes</button>
        <button type="button" class="green_button" data-bs-dismiss="modal" aria-label="Close">No</button>
        </div>
    </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){

        $('#delete-line-button').click(function() {
            $.ajax({
                type: "post",
                url: "http://127.0.0.1:3000/api/sector/delete.php",
                dataType: "json",
                data  :  JSON.stringify({
                    "id_sector" : $('#deleteModal #id_sector').val()
                })
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
