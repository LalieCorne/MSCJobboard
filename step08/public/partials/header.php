<link href="<?=_ROOT_URL_?>/public/assets/css/header.css" rel="stylesheet">
<header>
    <div id="title">
        <a class="nav-link" href="<?=_ROOT_URL_?>/view/index.php">
            <h1>JobBoard</h1>
        </a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=_ROOT_URL_?>/view/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=_ROOT_URL_?>/view/companies.php">Companies</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="userImg" src="<?=_ROOT_URL_?>/public/assets/img/user.svg" alt="user">  Profile</img>
                        </a>
                        <ul class="dropdown-menu dropdownStyle" aria-labelledby="navbarDropdown" id="menu-user">
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<div class="content-footer">
<script>
    var rq_menu = null;
    document.addEventListener('DOMContentLoaded', function(){
        if(localStorage.getItem("token") != null){
            rq_menu = $.ajax({
                method: "post",
                url: "http://127.0.0.1:3000/api/people/token.php",
                dataType: "json",
                data : JSON.stringify({
                    "token" : localStorage.getItem('token'),
                    "action" : "decrypt"
                })
            })
            .done(function(response){
                if (response.id_companies != null && response.id_companies > 0){
                    $("#menu-user").append('<li><a class="dropdown-item dropdownHover" id="log-out" href="<?=_ROOT_URL_?>/view/profile-company.php?id_company='+response.id_companies+'">Profile Company</a></li><li><a class="dropdown-item dropdownHover" href="<?=_ROOT_URL_?>/view/messages.php">Your messages</a></li><li><a class="dropdown-item dropdownHover" href="<?=_ROOT_URL_?>/view/create_ad.php">Create new advertisement</a></li>');
                } else if (response.id_admin != null && response.id_admin > 0){
                    $("#menu-user").append('<li><a class="dropdown-item dropdownHover" id="log-out" href="<?=_ROOT_URL_?>/view/dashboard-admin.php">Admin</a></li>');
                } else if (response.id_applicant != null && response.id_applicant > 0){
                    $("#menu-user").append('<li><a class="dropdown-item dropdownHover" href="<?=_ROOT_URL_?>/view/profile-applyer.php">Profile</a></li>');
                }
            })
            .fail(function() {
                console.log("error");
            })
            $("#menu-user").append('<li><a class="dropdown-item dropdownHover" id="log-out" href="<?=_ROOT_URL_?>/view/connection.php">Log out</a></li>');
        }else{
            $("#menu-user").append('<li><a class="dropdown-item dropdownHover" href="<?=_ROOT_URL_?>/view/connection.php">Login</a></li>');
        }
        $("#log-out").click(function(){
            localStorage.removeItem('token');
        })
    });
</script>