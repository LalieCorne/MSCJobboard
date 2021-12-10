<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/login.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/login.css" rel="stylesheet">

<div class="d-flex p-3 justify-content-center formInsc">
    <div class="card" id="ad">
        <div class="container" id="ad_title">
            <div class="row align-items-start">
                <div class="col">
                    <h3 class="card-title">Inscription</h3>
                </div>
            </div>
        </div>
            <form method="POST">
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
                            <div class="form-group">
                                <label for="password">Password : </label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" require>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password : </label>
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Password" require>
                            </div>
                            <label for="state">City : </label>
                            <select class="js-example-basic-single form-control" name="state" id="state">
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                            </select>
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
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone" require>
                                <label for="desc">Description : </label>
                                <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Description" require></textarea>
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
                                        <input type="text" class="form-control" name="nameCompany" id="nameCompany" placeholder="Company" require>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailCompany">Email address : </label>
                                        <input type="email" class="form-control" name="emailCompany" id="emailCompany" aria-describedby="emailHelp" placeholder="Email" require>
                                    </div>
                                    <label for="phoneCompany">Phone Company : </label>
                                    <input type="phone" class="form-control" name="phoneCompany" id="phoneCompany" placeholder="Phone" require>
                                    <label for="state">City Company : </label>
                                    <select class="js-example-basic-single form-control" name="state" id="state">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                    <label for="dateCompany">Start date :</label>
                                    <input type="date" id="dateCompany" name="dateCompany" class="form-control"></br>
                                    <label for="desc">Description : </label>
                                    <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Description" require></textarea>
                                </form>
                            </div>
                            <div id="formChoose" style="display : none;">
                                <label for="company">Company : </label>
                                <select class="js-example-basic-single form-control" name="company" id="company">
                                    <option value="MC">Microsoft</option>
                                    <option value="UB">Ubisoft</option>
                                </select></br></br>
                            </div>
                        </div>
                        <div id="formAdmin"  style="display : none;">
                            <label for="phone">Phone : </label>
                            <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone" require>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="red_button">Inscription</button> </br>
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
        $('input[type=radio][name=radioCompany]').change(function(){
            if (this.value == 'create'){
                $("#formChoose").hide();
                $("#formCreate").show();
            }else if (this.value == 'choose'){
                $("#formChoose").show();
                $("#formCreate").hide();
            }
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    });
</script>
<?php
include("../controler/import-foot.controler.php");
?>