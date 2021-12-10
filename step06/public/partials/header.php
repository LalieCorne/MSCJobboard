<link href="<?=_ROOT_URL_?>/public/assets/css/header.css" rel="stylesheet">
<header>
    <div id="title">
        <h1>JobBoard</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=_ROOT_URL_?>/view/index.php">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=_ROOT_URL_?>/view/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Advertisements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Companies</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="userImg" src="<?=_ROOT_URL_?>/public/assets/img/user.svg" alt="user">  Profile</img>
                        </a>
                        <ul class="dropdown-menu dropdownStyle" aria-labelledby="navbarDropdown">
                            <?php 
                            if($_SESSION["people"] != false){
                                echo '<li><a class="dropdown-item dropdownHover" href="'._ROOT_URL_.'/view/connection.php">Log out</a></li>';
                            }else{
                                echo '<li><a class="dropdown-item dropdownHover" href="'._ROOT_URL_.'/view/connection.php">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
</header>