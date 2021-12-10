<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/connection.controler.php");
?>
<link href="<?=_ROOT_URL_?>/public/assets/css/authentification.css" rel="stylesheet">

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
                    <button type="submit" class="red_button">Connection</button> </br>
                </div>
                <a href="<?=_ROOT_URL_?>/view/login.php" class="linkInsc">If you don't already have an account please sign in here.</a>
            </form>
        </div>
        
    </div>
</div>

<?php
include("../controler/import-foot.controler.php");
?>