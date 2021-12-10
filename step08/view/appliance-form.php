<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/index.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/appliance-form.css" rel="stylesheet">

<button class="red_button launchApplyModal" type="button" data-bs-toggle="modal" data-bs-target="#applyModal">
    Open apply modal
</button>

<?php include(_ROOT_DIR_."/partials/modal/apply-form-modal.php")
?>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var myModal = document.getElementById('applyModal')
        var myInput = $("#launchApplyModal")
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    });
</script>

<?php
include(_ROOT_DIR_ADMIN_."/controler/import-foot.controler.php");
?>