<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/Sector.class.php';
    
    $database = Database::getInstance();
    $db = $database->getConnection();
    
    $item = new Sector($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id_sector = $data->id_sector;
    
    if($item->delete()){
        http_response_code(200);
        echo json_encode("Sector deleted.");
    } else{
        http_response_code(404);
        echo json_encode("Sector could not be deleted");
    }
?>