<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/login.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/create_ad.css" rel="stylesheet">

<div class="d-flex p-3 justify-content-center formInsc">
    <div class="card create_ad">
        <div class="container create_ad_title">
            <div class="row align-items-start">
                <div class="col">
                    <h3 class="card-title">Create a new advertisement</h3>
                </div>
            </div>
        </div>
            <div id="errorMsgCreateAd"></div>
            <form id="inscrition-form" method="POST">
                <div class="content">
                    <div class="row">
                        <input id="id_people" type="hidden">
                        <input id="id_company" type="hidden">
                        <div class="form-group">
                            <label for="titel">Title :</label>
                            <input type="text" class="form-control" name="title" id="input_title">
                        </div>
                        <div class="form-group">
                            <label for="sector">Sector :</label>
                            <select class="create_ad_select form-select" name="sector" id="sector">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City :</label>
                            <select class="create_ad_select form-select" name="city" id="city">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type contract :</label>
                            <select class="create_ad_select form-select" name="type" id="type">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description :</label>
                            <textarea name="desc" id="desc" class="form-control"></textarea>
                        </div>
                    </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="red_button" id="button_create_ad">Create</button> </br>
                </div>
            </form>
        </div>
    </div>
</div>



<script >
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
            $("#id_people").val(response.id_people);
            $("#id_company").val(response.id_companies);
        })
        .fail(function() {
        });
        $.ajax({
            method: "get",
            url: "http://127.0.0.1:3000/api/sector/read.php",
            dataType: "json"
        })
        .done(function(response){
            sectors = response.body;
            option = $("#sector").html();
            for (k=0; k<response.itemCount; k++) {
                sector = sectors[k];
                option = option + '<option value="'+sector.id_sector+'">'+sector.label+'</option>';
            }
            $("#sector").html(option)
        })
        .fail(function() {
        });
        $.ajax({
            method: "get",
            url: "http://127.0.0.1:3000/api/city/read.php",
            dataType: "json"
        })
        .done(function(response){
            cities = response.body;
            option = $("#city").html();
            for (k=0; k<response.itemCount; k++) {
                city = cities[k];
                option = option + '<option value="'+city.id_city+'">'+city.label+'</option>';
            }
            $("#city").html(option)
        })
        .fail(function() {
        });
        $.ajax({
            method: "get",
            url: "http://127.0.0.1:3000/api/type/read.php",
            dataType: "json"
        })
        .done(function(response){
            types = response.body;
            option = $("#type").html();
            for (k=0; k<response.itemCount; k++) {
                type = types[k];
                option = option + '<option value="'+type.id_type+'">'+type.label+'</option>';
            }
            $("#type").html(option)
        })
        .fail(function() {
        });
        $("#button_create_ad").click(function() {
            $("#errorMsgCreateAd").text(null)
            if ((($("#input_title").val()) != '') && (($("#desc").val()) != '')) {
                $.ajax({
                    type: "post",
                    url: "http://127.0.0.1:3000/api/advertisement/create.php",
                    dataType: "json",
                    data : JSON.stringify({
                        "title" : $("#input_title").val(),
                        "description" : $("#desc").val(),
                        "id_companies" : $("#id_company").val(),
                        "id_people" : $("#id_people").val(),
                        "id_type" : $("#type").val(),
                        "id_city" : $("#city").val(),
                        "id_sector" : $("#sector").val()
                    })
                })
                .done(function(response){
                    $("#input_title").val(null),
                    $("#desc").val(null),
                    $("#ToastText").text('Your advertisment has been created.')
                })
                .fail(function() {
                    console.log('failDB')
                });
            } else  {
                $("#input_title").val(null),
                $("#desc").val(null),
                $("#errorMsgCreateAd").text('Please enter a title and a description.')
            }
        });
    });
</script>


<?php
include("../controler/import-foot.controler.php");
?>