<link href="<?=_ROOT_URL_?>/public/assets/css/appliance-form.css" rel="stylesheet">

<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content apply-modal">
            <div class="modal-header apply-modal_header">
            <h5 class="modal-title" id="applyModalLabel">Appliance form</h5>
            <button type="button" class="red_close_button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body apply-modal-content" id="apply-body">
                <div id="errorMsgApply"></div>
                <form>
                    <input type="hidden"  id="id_company">
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
                        <textarea class="form-control" name="msg" id="msg_area" placeholder="Type your message here."></textarea>
                    </div>
                    <div class="mb-3">
                        <div id="files">Your files :</div>
                        <?php include(_ROOT_DIR_."/partials/modal/add_files-toast.php")?>
                    </div>
                    <button type="submit" id="submitApplyForm"class="submit_button red_button">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $.ajax({
            method: "post",
            url: "http://127.0.0.1:3000/api/people/token.php",
            dataType: "json",
            data : JSON.stringify({
                "token" : localStorage.getItem('token'),
                "action" : "decrypt"
            })
        })
        .done(function(response){
            console.log(response);
            $("#Fname_input").val(response.first_name);
            $("#Lname_input").val(response.last_name);
            $("#email_input").val(response.email);
            $("#phone_input").val(response.phone);
        })
        .fail(function() {
        });
        var receiver = '';
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:3000/api/companies/single_read.php?id_companies="+$("#id_company").val()
        })
        .done(function (response) {
            console.log(response);
            $("#submitApplyForm").click(function() {
                $.ajax({
                method: "post",
                url: "http://127.0.0.1:3000/controler/send_mail.php",
                dataType: "json",
                data : JSON.stringify({
                    "receiver" : response.email,
                    "sender_Fname" : $("#Fname_input").val(),
                    "sender_Lname" : $("#Lname_input").val(),
                    "email_sender" : $("#email_input").val(),
                    "tel_sender" : $("#phone_input").val(),
                    "content" : $("#msg_area").val()
                    })
                })
            })
        })
        .fail(function () {
        });
        $("#submitApplyForm").click(function() {
            $("#errorMsgApply").text(null)
            if (($("#msg_area").val()) != '') {
                $.ajax({
                    type: "post",
                    url: "http://127.0.0.1:3000/api/log_mail/create.php",
                    dataType: "json",
                    data : JSON.stringify({
                        "id_recipient" : $("#id_company").val(),
                        "obj" : "Response to your advertisment",
                        "first_name_sender" : $("#Fname_input").val(),
                        "last_name_sender" : $("#Lname_input").val(),
                        "email_sender" : $("#email_input").val(),
                        "tel_sender" : $("#phone_input").val(),
                        "content" : $("#msg_area").val()
                    })
                })
                .done(function(response){
                    $("#errorMsgApply").text('Your message has been send.')
                })
                .fail(function() {
                    console.log('failDB')
                });
            } else  {
                $("#input_title").val(null),
                $("#desc").val(null),
                $("#errorMsgApply").text('Please enter your message.')
            }
        });
    });
</script>

