<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/connection.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/authentification.css" rel="stylesheet">

<div id="msg-error"></div>

<div class="d-flex p-2 justify-content-center">
    <div class="card" id="ad">
        <div class="container" id="ad_title">
            <div class="row align-items-start">
                <div class="col">
                    <h3 class="card-title">Connection</h3>
                </div>
            </div>
        </div>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" require>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" require>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="red_button" id="buttonCon">Connection</button> </br>
                </div>
                <a href="<?=_ROOT_URL_?>/view/login.php" class="linkInsc">If you don't already have an account please sign in here.</a>
            </form>
        </div>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $("#buttonCon").click(function(){
            $.ajax({
                type: "post",
                url: "http://127.0.0.1:3000/api/people/token.php",
                dataType: "json",
                data : JSON.stringify({
                    "email" : $("#email").val(),
                    "password" : $("#password").val()
                })
            })
            .done(function(response){
                if(response.token != null){
                    localStorage.setItem('token', JSON.stringify(response.token));
                    $.ajax({
                        method: "post",
                        url: "http://127.0.0.1:3000/api/people/token.php",
                        dataType: "json",
                        data : JSON.stringify({
                            "token" : response.token,
                            "action" : "decrypt"
                        })
                    })
                    .done(function(response){
                        if (response.id_admin > 0 && response.id_admin != null){
                            window.location.href = "dashboard-admin.php";
                        }else{
                            window.location.href = "index.php";
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                }else{
                    if(!$('#msg-alert').length){
                        $("#msg-error").append('<div class="alert alert-danger" role="alert" id="msg-alert">This user does not exist.</div>');
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        });
        
    });
</script>

<?php
include("../controler/import-foot.controler.php");
?>