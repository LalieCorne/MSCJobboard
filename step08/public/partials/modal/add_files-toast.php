<link href="<?=_ROOT_URL_?>/public/assets/css/appliance-form.css" rel="stylesheet">

<button type="button" class="red_button" id="addFileToastBtn">Add your files</button>

<div class="position-fixed">
    <div id="addFilesToast" class="toast file_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header file_toast-header ">
            <strong class="me-auto">Add your files</strong>
            <button type="button" class="red_close_button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <form>
                <div class="mb-3">
                    <input type="file" id="file" class="form-control">
                </div>
                <button type="button" id="addFileBtn" class="red_button" data-bs-dismiss="toast" aria-label="Close">Upload</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var toastTrigger = document.getElementById('addFileToastBtn');
        var toastLiveExample = document.getElementById('addFilesToast');
        var addFile = document.getElementById('addFileBtn');
        if (toastTrigger) {
            toastTrigger.addEventListener('click', function () {
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            })
        };
        addFile.addEventListener('click', function () {
            console.log($('#files').text());
            $("#files").html(($("#files").html())+"<br/>"+($('#file').val()))
            console.log($('#file').text());
        });
    });
</script>