<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/People.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $item = new People($db);

    $data = json_decode(file_get_contents("php://input"));

    foreach($data as $key => $value){
        $item->$key = $value;
    }
    
    $return = $item->create();

    if((intval($return) != 0) == false){
        http_response_code(404);
        echo json_encode(array('error' => $return));
    }else if(intval($return) > 0){
        http_response_code(201);
        echo json_encode(array('id_people' => $return));
    } else{
        http_response_code(404);
        echo 'People could not be created.';
    }
?>