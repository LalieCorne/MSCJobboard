<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/index.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/profile-applyer.css" rel="stylesheet">


<h3 class="page_title">Profile</h3>
<div class="d-flex p-2 justify-content-center">
<div class="card" id="ad">
        <div class="container" id="ad_title">
            <div class="row align-items-start">
                    <h3 class="card-title" id="name-applyer"></h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="d-img col-sm-6">
                    <img class="userImgProfile" src="<?=_ROOT_URL_?>/public/assets/img/user.svg" alt="user"></img>
                </div>
                <div class="col-sm-6" id="info-applyer">
                </div>         
            </div>
        </div>
        <div id="desc-applyer">

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
            $.ajax({
                method:"get",
                url: "http://127.0.0.1:3000/api/people/single_read.php?id_people="+response.id_people
            })
            .done(function(responseInfo){
                $("#name-applyer").append(responseInfo.last_name+' '+responseInfo.first_name);
                $("#desc-applyer").append('<p class="desc-applyer">'+responseInfo.description+'</p>');
                $("#info-applyer").append('<p class="info-applyer">'+responseInfo.email+'</br>'+responseInfo.phone+'</p>');
            })
            .fail(function() {
                console.log("error");
            });
        })
        .fail(function() {
            console.log("error");
        })
        
    })
</script>
<?php
include("../controler/import-foot.controler.php");
?>