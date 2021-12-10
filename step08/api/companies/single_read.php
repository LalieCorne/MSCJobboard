<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/Companies.class.php';
    

    $database = Database::getInstance();
    $db = $database->getConnection();

    $item = new Companies($db);

    $item->id_companies = isset($_GET['id_companies']) ? $_GET['id_companies'] : die();

    $item->getSingle();

    if($item->name != null){
        // create array
        $emp_arr = array(
            "id_companies" => $item->id_companies,
            "name" => $item->name,
            "email" => $item->email,
            "phone" => $item->phone,
            "creation_date" => $item->creation_date,
            "description" => $item->description,
            "id_city" => $item->id_city,
            "id_people" => $item->id_people,
            "id_sector" => $item->id_sector,
            "labelCity" => $item->labelCity,
            "labelSector" => $item->labelSector
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Companies not found.");
    }
?>