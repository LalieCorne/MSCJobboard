<?php
$title = '';
include("../controler/import-head.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/login.css" rel="stylesheet">

<div id="msg-error"></div>

<div class="d-flex p-3 justify-content-center formInsc">
    <div class="card" id="ad">
        <div class="container" id="ad_title">
            <div class="row align-items-start">
                <div class="col">
                    <h3 class="card-title">Inscription</h3>
                </div>
            </div>
        </div>
            <form id="inscrition-form" method="POST">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="firstName">First Name : </label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" require>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name : </label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" require>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address : </label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" require>
                            </div>
                            <div class="alert alert-danger" role="alert" id="msg-error-mail" style="display : none;">Please enter a correct email address.</div>
                            <div class="form-group">
                                <label for="password">Password : </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" require>
                            </div>
                            <!-- <div class="form-group">
                                <label for="confirmPassword">Confirm Password : </label>
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Password" require>
                            </div> -->
                        </div>
                        <div class="col-sm-6">
                        Type : 
                        <form id="my_radio_type">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioType" id="radioType1" value="applyer" checked>
                                <label class="form-check-label" for="radioType1">Applyer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioType" id="radioType2" value="company">
                                <label class="form-check-label" for="radioType2">Company</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioType" id="radioType3" value="admin">
                                <label class="form-check-label" for="radioType3">Adminisrator</label>
                            </div>
                            <div id="formApplyer" class="form-group">
                                <label for="phone">Phone : </label>
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone" maxlength="10">
                                <label for="desc">Description : </label>
                                <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Description"></textarea>
                            </div>
                            <div id="formCompany" style="display : none;">
                            Create or choose company ?
                            <form id="my_radio_companie">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioCompany" id="radioCompany1" value="create" checked>
                                    <label class="form-check-label" for="radioCompany1">Create</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioCompany" id="radioCompany2" value="choose">
                                    <label class="form-check-label" for="radioCompany2">Choose</label>
                                </div>
                            </form>
                            <div id="formCreate">
                                <form>
                                    <div class="form-group">
                                        <label for="nameCompany">Name Company : </label>
                                        <input type="text" class="form-control" name="nameCompany" id="nameCompany" placeholder="Company">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailCompany">Email address : </label>
                                        <input type="email" class="form-control" name="emailCompany" id="emailCompany" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="alert alert-danger" role="alert" id="msg-error-mail-com" style="display : none;">Please enter a correct email address.</div>
                                    <label for="phoneCompany">Phone Company : </label>
                                    <input type="phone" class="form-control" name="phoneCompany" id="phoneCompany" placeholder="Phone" maxlength="10">
                                    <label for="state">City Company : </label>
                                    <select class="js-example-basic-single form-control selector" name="state" id="state">
                                    </select> </br>
                                    <label for="sector">Sector Company : </label>
                                    <select class="js-example-basic-single form-control selector" name="sector" id="sector">
                                    </select> </br>
                                    <label for="description">Description : </label>
                                    <textarea class="form-control" id="description" name="desc" rows="3" placeholder="Description"></textarea>
                                </form>
                            </div>
                            <div id="formChoose" style="display : none;">
                                <label for="company">Company : </label>
                                <select class="js-example-basic-single form-control selector" name="company" id="company">
                                </select></br></br>
                            </div>
                        </div>
                        <div id="formAdmin"  style="display : none;">
                            <label for="phone-adm">Phone : </label>
                            <input type="phone" class="form-control" name="phone" id="phone-adm" placeholder="Phone" maxlength="10">
                        </div>
                    </div>
                </div>
                <div id="msg-error-exist"></div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="red_button" id="buttonIns">Sign up</button> </br>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        $('input[type=radio][name=radioType]').change(function(){
            if (this.value == 'applyer'){
                $("#formAdmin").hide();
                $("#formApplyer").show();
                $("#formCompany").hide();
            }else if (this.value == 'admin'){
                $("#formAdmin").show();
                $("#formApplyer").hide();
                $("#formCompany").hide();
            }else if (this.value == 'company'){
                $("#formAdmin").hide();
                $("#formApplyer").hide();
                $("#formCompany").show();
            }
        });
        if ($('input[type=radio][name=radioCompany]:checked').val() == 'create'){
            $.ajax({
                type: "get",
                url:"http://127.0.0.1:3000/api/city/read.php"
            })
            .done(function(city){
                for (var element in city.body){
                    $("#state").append('<option value="'+city.body[element].id_city+'">'+city.body[element].label+'</option>');
                }
            })
            .fail(function(){
                console.log("error");
            })

            $.ajax({
                type: "get",
                url:"http://127.0.0.1:3000/api/sector/read.php"
            })
            .done(function(city){
                for (var element in city.body){
                    $("#sector").append('<option value="'+city.body[element].id_sector+'">'+city.body[element].label+'</option>');
                }
            })
            .fail(function(){
                console.log("error");
            })

            $("#formChoose").hide();
            $("#formCreate").show();
        }
        $('input[type=radio][name=radioCompany]').change(function(){
            if (this.value == 'create'){
                $("#formChoose").hide();
                $("#formCreate").show();
            }else if (this.value == 'choose'){
                
                $.ajax({
                    type: "get",
                    url:"http://127.0.0.1:3000/api/companies/read.php"
                })
                .done(function(companies){
                    for (var element in companies.body){
                        $("#company").append('<option value="'+companies.body[element].id_companies+'">'+companies.body[element].name+'</option>');
                    }
                })
                .fail(function(){
                    console.log("error");
                })

                $("#formChoose").show();
                $("#formCreate").hide();
            }
        });
        // Click to inscrption
        var id_people = null ;
        var id_company = null ;
        var id_admin = null;
        var id_applyer = null;
        var rq_company = null;
        var rq_applyer = null;
        var rq_admin = null;
        var regex = new RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
        $("#buttonIns").click(function(){
            if (!regex.test($("#email").val())){
                $("#msg-error-mail").show();
            }else{
                $("#msg-error-mail").hide();
            }
            if(!regex.test($("#emailCompany").val())){
                $("#msg-error-mail-com").show();
            }else{
                $("#msg-error-mail-com").hide();
            }
            var phone = $("#phone").val().replace(/(\d\d(?!$))/g,"$1 ");
            var phoneAdmin = $("#phone-adm").val().replace(/(\d\d(?!$))/g,"$1 ");
            var phoneCom = $("#phoneCompany").val().replace(/(\d\d(?!$))/g,"$1 ");
            // create people
            if($("#fistName").val() != "" && $("#lastName").val() != "" && $("#email").val() != "" && $("#password").val() != "" && regex.test($("#email").val())){
                var radioButtonC = $('input[type=radio][name=radioCompany]:checked').val();
                var radioButton = $('input[type=radio][name=radioType]:checked').val();
                if ( radioButton == 'company' && radioButtonC == 'choose' || 
                    radioButton == 'company' && radioButtonC == 'create' && $("#nameCompany").val() != "" && $("#emailCompany").val() != "" && phoneCom != "" && $("#description").val() != "" && regex.test($("#emailCompany").val()) ||
                    radioButton == 'admin' && phoneAdmin != "" ||
                    radioButton == 'applyer' && phone != "" && $("#desc").val() != ""
                ){
                    var rq_people = $.ajax({
                        type: "post",
                        url: "http://127.0.0.1:3000/api/people/create.php",
                        dataType : "json",
                        data : JSON.stringify({
                            "first_name" : $("#firstName").val(),
                            "last_name" : $("#lastName").val(),
                            "email" : $("#email").val(),
                            "password" : $("#password").val()
                        })
                    })
                    .done(function(people){
                        id_people = people.id_people;
                        $("#msg-error-exist").hide();
                        if (!id_people){
                            $("#msg-error-exist").show();
                            if(!$("#msg-exist").length){
                                $("#msg-error-exist").append('<div class="alert alert-danger" role="alert" id="msg-exist">Mail exist</div>');
                            }
                        }
                    })
                    .fail(function(test){
                        
                    })
                }else{
                    if(!$('#msg-alert').length){
                        $("#msg-error").append('<div class="alert alert-danger" role="alert" id="msg-alert">Please fill in all fields.</div>');
                    }
                }
                rq_people.done(function(){
                    if(id_people){
                        // create company
                        if ($('input[type=radio][name=radioType]:checked').val() == 'company'){
                            if($('input[type=radio][name=radioCompany]:checked').val() == 'create'){
                                if($("#nameCompany").val() != "" && $("#emailCompany").val() != "" && phoneCom != "" && $("#description").val() != "" && regex.test($("#emailCompany").val())){
                                    rq_people.done(function(){
                                        rq_company = $.ajax({
                                            type :"post",
                                            url: "http://127.0.0.1:3000/api/companies/create.php",
                                            dataType: "json",
                                            data: JSON.stringify({
                                                "name" : $("#nameCompany").val(),
                                                "email" : $("#emailCompany").val(),
                                                "phone" : phoneCom,
                                                "description" : $("#description").val(),
                                                "id_city" : $("#state").val(),
                                                "id_people" : id_people,
                                                "id_sector" : $("#sector").val()
                                            })
                                        })
                                        .done(function(company){
                                            id_company = company.id_companies;
                                        })
                                        .fail(function(){
                                        })
                                    })
                                }
                            }
                        }else if ($('input[type=radio][name=radioType]:checked').val() == 'applyer'){ // create applyer
                            if (phone != "" && $("#desc").val() != ""){
                                var rq_applyer = $.ajax({
                                    type :"post",
                                    url: "http://127.0.0.1:3000/api/applicant/create.php",
                                    dataType: "json",
                                    data: JSON.stringify({
                                        "phone" : phone,
                                        "description" : $("#desc").val()
                                    })
                                })
                                .done(function(applyer){
                                    id_applyer = applyer.id_applicant;
                                })
                                .fail(function(){
                                })
                            }
                        }else if ($('input[type=radio][name=radioType]:checked').val() == 'admin'){ // create amdin
                            if (phoneAdmin != ""){
                                var rq_admin = $.ajax({
                                    type :"post",
                                    url: "http://127.0.0.1:3000/api/admin/create.php",
                                    dataType: "json",
                                    data: JSON.stringify({
                                        "phone" : phoneAdmin
                                    })
                                })
                                .done(function(admin){
                                    id_admin = admin.id_admin;
                                })
                                .fail(function(){
                                })
                            }
                        }

                        if(rq_people){
                            rq_people.done(function(){
                                if ($('input[type=radio][name=radioType]:checked').val() == 'company'){
                                    if ($('input[type=radio][name=radioCompany]:checked').val() == 'create'){
                                        rq_company.done(function(){
                                            // create status people for company
                                            $.ajax({
                                                    type: "post",
                                                    url: "http://127.0.0.1:3000/api/people_status/create.php",
                                                    dataType: "json",
                                                    data: JSON.stringify({
                                                        "id_people" : id_people,
                                                        "id_companies" : id_company
                                                    })
                                            })
                                            .done(function(status_people){
                                                window.location.href = "connection.php";
                                            })
                                            .fail(function(){
                                            })
                                        })
                                    }else if ($('input[type=radio][name=radioCompany]:checked').val() == 'choose'){
                                        rq_company.done(function(){
                                            // create status people for company
                                            $.ajax({
                                                    type: "post",
                                                    url: "http://127.0.0.1:3000/api/people_status/create.php",
                                                    dataType: "json",
                                                    data: JSON.stringify({
                                                        "id_people" : id_people,
                                                        "id_companies" : $('#company').val()
                                                    })
                                            })
                                            .done(function(status_people){
                                                window.location.href = "connection.php";
                                            })
                                            .fail(function(){
                                            })
                                        })
                                    }
                                    
                                }else if($('input[type=radio][name=radioType]:checked').val() == 'applyer'){
                                    rq_applyer.done(function(){
                                        // create status people for applyer
                                        $.ajax({
                                                type: "post",
                                                url: "http://127.0.0.1:3000/api/people_status/create.php",
                                                dataType: "json",
                                                data: JSON.stringify({
                                                    "id_people" : id_people,
                                                    "id_applicant" : id_applyer
                                                })
                                        })
                                        .done(function(status_people){
                                            window.location.href = "connection.php";
                                        })
                                        .fail(function(){
                                        })
                                    })
                                }else if($('input[type=radio][name=radioType]:checked').val() == 'admin'){
                                    rq_admin.done(function(){
                                        // create status people for admin
                                        $.ajax({
                                                type: "post",
                                                url: "http://127.0.0.1:3000/api/people_status/create.php",
                                                dataType: "json",
                                                data: JSON.stringify({
                                                    "id_people" : id_people,
                                                    "id_admin" : id_admin
                                                })
                                        })
                                        .done(function(status_people){
                                            window.location.href = "connection.php";
                                        })
                                        .fail(function(){
                                        })
                                    })
                                }
                            })
                        }
                    }
                })
            }else{
                if(!$('#msg-alert').length){
                    $("#msg-error").append('<div class="alert alert-danger" role="alert" id="msg-alert">Please fill in all fields.</div>');
                }
            }
        });
    });
    $(document).ready(function() {
            $('.js-example-basic-single').select2();
    });
</script>
<?php
include("../controler/import-foot.controler.php");
?>