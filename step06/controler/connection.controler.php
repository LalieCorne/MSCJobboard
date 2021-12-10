<?php
if($_SESSION["id_people"] != false){
    session_destroy();
    header("Location:"._ROOT_URL_."/view/connection.php");
    exit();
}

if(isset($_POST["email"])){
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $objPeople = new People($pCon ->getInstance());

    $objPeople -> userLogin($email, $pass);

    if($objPeople -> userLogin($email, $pass) == true){
        session_start();
        $_SESSION["id_people"] = $objPeople->getVal('id_people');
        header("Location: ../view/index.php");
        exit();
    }else{
        $_SESSION["id_people"] = false;
        echo "<div class='alert alert-danger' role='alert'>
        This user does not exist.</div>";
    }
}