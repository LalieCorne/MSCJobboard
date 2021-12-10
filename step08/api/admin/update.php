<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/Admin.class.php';
    
    $database = Database::getInstance();
    $db = $database->getConnection();
    
    $item = new Admin($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_admin = $data->id_admin;
    $item->getSingle();
    
    // employee values
    foreach($data as $key => $val){
        $item->$key = $val;
    }


    if($item->update()){
        http_response_code(200);
        echo json_encode("Admin data updated.");
    } else{
        http_response_code(404);
        echo json_encode("Admin could not be updated");
    }
?>