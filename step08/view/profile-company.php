<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/index.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/profile-applyer.css" rel="stylesheet">
<link href="<?=_ROOT_URL_?>/public/assets/css/advertisement.css" rel="stylesheet">


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
            <div id="desc-applyer"></div>
        </div>
    </div>
</div>
<div class="container">
    <div id="advert" class="row d-flex p-3 justify-content-center"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        $.ajax({
            method:"get",
            url: "http://127.0.0.1:3000/api/companies/single_read.php?id_companies="+<?=$_GET['id_company']?>
        })
        .done(function(responseInfo){
            $("#name-applyer").append(responseInfo.name);
            $("#desc-applyer").append('<p class="desc-applyer">'+responseInfo.description+'</p>');
            $("#info-applyer").append('<p class="info-applyer">'+responseInfo.email+'</br>'+responseInfo.phone+'</br>'+responseInfo.labelSector+'</p>');
        })
        .fail(function() {
            console.log("error");
        });

        $.ajax({
            type: "get",
            url:"http://127.0.0.1:3000/api/advertisement/read.php?id_companies="+<?=$_GET['id_company']?>
        })
        .done(function(advertisement){
            if (advertisement){
                $("#advert").append('<h3 class="page_title">Advertissement</h3>');
                for (var element in advertisement.body){
                    $("#advert").append('<div class="card ad col-12">'+
                        '<div class="container ad_title">'+
                            '<div class="row align-items-start">'+
                                '<div class="col">'+
                                    '<h3 class="card-title">'+advertisement.body[element].title+'</h3>'+
                                '</div>'+
                                '<div class="col ad-info">'+
                                advertisement.body[element].creation_date+'<br>'+advertisement.body[element].labelCompanies+"<br>"+advertisement.body[element].labelType+"<br>"+advertisement.body[element].labelCity+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="card-text ad-content" id="'+advertisement.body[element].id_advertisement+'">'+
                            '<p class="ad-text">'+
                                advertisement.body[element].description+
                            '</p>'+
                        '</div>'+
                    '</div>');
                }
            }
        })
        .fail(function(){
            console.log("error");
        })
    })
</script>
<?php
include("../controler/import-foot.controler.php");
?>