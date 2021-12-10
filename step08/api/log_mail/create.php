<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/LogMail.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $item = new LogMail($db);

    $data = json_decode(file_get_contents("php://input"));

    foreach($data as $key => $value){
        $item->$key = $value;
    }
    
    if($lastId = $item->create()){
        http_response_code(201);
        echo json_encode(array('id_log_mail' => $lastId));
    } else{
        http_response_code(404);
        echo 'Log mail could not be created.';
    }
?>