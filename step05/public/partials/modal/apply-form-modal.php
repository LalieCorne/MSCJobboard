<link href="<?=_ROOT_URL_?>/public/assets/css/appliance-form.css" rel="stylesheet">

<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content apply-modal">
            <div class="modal-header apply-modal_header">
            <h5 class="modal-title" id="applyModalLabel">Appliance form</h5>
            <button type="button" class="red_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply-modal-content" id="apply-body">
                <form>
                    <div class="mb-3">
                        <label for="Fname" class="form-label">First name</label>
                        <input type="text" class="form-control" name="Fname" id="Fname_input">
                    </div>
                    <div class="mb-3">
                        <label for="Lname" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="Lname" id="Lname_input">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your email</label>
                        <input type="email" class="form-control" name="email" id="email_input">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Your phone</label>
                        <input type="nuùber" class="form-control" name="phone" id="phone_input" required minlength="10" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label for="msg" class="form-label">Your message</label>
                        <textarea class="form-control" name="msg" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="mb-3">
                        <div id="files">Your files :</div>
                        <?php include(_ROOT_DIR_."/partials/modal/add_files-toast.php")?>
                    </div>
                    <button type="submit" class="submit_button red_button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $.ajax({
            method: "post",
            url: "../public/ajax/apply-info.ajax.php",
            dataType: "json",
        })
        .done(function(response){
            $("#Fname_input").val(response.FirstName);
            $("#Lname_input").val(response.LastName);
            $("#email_input").val(response.email);
            $("#phone_input").val(response.phone);
        })
        .fail(function() {
            $("#Fname_input").val(null);
            $("#Lname_input").val(null);
            $("#email_input").val(null);
            $("#phone_input").val(null);
        });
    });
</script>

