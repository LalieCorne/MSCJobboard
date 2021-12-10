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
    
    $item->id_people = $data->id_people;
    
    if($item->delete()){
        http_response_code(200);
        echo json_encode("People deleted.");
    } else{
        http_response_code(404);
        echo json_encode("People could not be deleted");
    }
?>