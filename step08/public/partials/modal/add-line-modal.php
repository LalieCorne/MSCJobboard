<link href="<?=_ROOT_URL_?>/public/assets/css/admin-dashboard.css" rel="stylesheet">

<div class="modal fade" id="addLineModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content admin-modal">
            <div class="modal-header admin-modal_header">
            <h5 class="modal-title" id="exampleModalLabel">Add Element</h5>
            <button type="button" class="green_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body admin-modal-content">
                <label for="nameAdd">Type</label>
                <input class="form-control" type="text" id="nameAdd" name="name">
                
                <label for="select">Parent</label>
                <select style="width: 100%" class="form-control js-example-basic-single" type="text" id="selectAdd" name="parent">
                    <option value=""></option>
                </select>

            </div>
            <div class="admin-modal_footer modal-footer">
            <button type="button" class="green_button" id="add-line-button" aria-label="Close">Add new line</button><!--data-bs-dismiss="modal"-->
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                dropdownParent: $("#addLineModal")
            });
        });

        $("#addLineModal").on('shown.bs.modal', function(){
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:3000/api/sector/read.php"
            })
            .done(function(reponse){
                reponse.body.forEach((item) => {
                    $('#selectAdd').append('<option value="'+item.id_sector+'">'+item.label+'</option>')
                })
            })
            .fail(function(){
                console.log('error')
            })
        })

        $('#add-line-button').click(function() {
            console.log($('#nameAdd').val());

            if($('#nameAdd').val() != '' && $('#nameAdd').val() != null){
                $.ajax({
                    type: "post",
                    url: "http://127.0.0.1:3000/api/sector/create.php",
                    dataType: "json",
                    data  :  JSON.stringify({
                        "label" : $('#nameAdd').val(),
                        "id_sector_parent" : $('#selectAdd option:selected').val()
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