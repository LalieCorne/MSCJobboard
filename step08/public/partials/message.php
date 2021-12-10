<link href="<?=_ROOT_URL_?>/public/assets/css/message.css" rel="stylesheet">

<div class="container">
    <div id="messages" class="row d-flex p-3 justify-content-center">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $.ajax({
            type: "post",
            url: "http://127.0.0.1:3000/api/log_mail/read.php",
            dataType: "json",
            data : JSON.stringify({
                "token" : localStorage.getItem('token')
            })
        })
        .done(function (response) {
            msg = response.body
            for (k=0; k<(response.itemCount); k++) {
                answer = msg[k];
                content = $("#messages").html();
                content = content +
                '<div class="msg" id="'+k+'" data-id="'+k+'">'+
                    '<div class="card msg_new col-12">'+
                        '<div class="position-absolute top-0 start-100 translate-middle new">New</div>'+
                        '<div class="container msg_header_new">'+
                            '<div class="row align-items-start">'+
                                '<div class="col">'+
                                    '<h3 class="card-title">Answer to : </h3>'+
                                    '<div class="sender">'+
                                        'From : '+answer.first_name_sender+' '+answer.last_name_sender+
                                    '</div>'+
                                '</div>'+
                                '<div class="col msg-info">'+
                                answer.email_sender+'<br>'+answer.tel_sender+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-text msg-content">'+
                            '<p class="msg-text">'+
                                answer.content+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                '</div>'
                $("#messages").html(content);
            }
            $('.msg').click(function () {
                id = $(this).attr('data-id');
                answer = msg[id];
                $("#"+id).html(
                    '<div class="card msg_read col-12">'+
                        '<div class="container msg_header_read">'+
                            '<div class="row align-items-start">'+
                                '<div class="col">'+
                                    '<h3 class="card-title">Answer to : </h3>'+
                                    '<div class="sender">'+
                                        'From : '+answer.first_name_sender+' '+answer.last_name_sender+
                                    '</div>'+
                                '</div>'+
                                '<div class="col msg-info">'+
                                answer.email_sender+'<br>'+answer.tel_sender+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-text msg-content">'+
                            '<p class="msg-text">'+
                                answer.content+
                            '</p>'+
                        '</div>'+
                    '</div>'
                    );
            });
        })
        .fail(function() {
            console.log('fail');
        });
    });
</script>