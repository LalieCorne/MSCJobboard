<?php

    $objName ='people';
    $idName = 'id_'.$objName;
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/'.ucfirst($objName).'.class.php';
    

    $database = Database::getInstance();
    $db = $database->getConnection();

    $objName = ucfirst($objName);
    $item = new $objName($db);

    $item->id_people = isset($_GET[$idName]) ? $_GET[$idName] : die();
  
    $item->getSingle();

    if($item->first_name != null){
        // create array

        foreach(get_object_vars($item) as $key => $value){
            $emp_arr[$key] = $value;
        }

      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("People not found.");
    }
?>