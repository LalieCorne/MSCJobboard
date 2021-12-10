<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/City.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $items = new City($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_city" => $id_city,
                "label" => $label,
                "zip_code" => $zip_code,
                "labelSector" => $labelSector,
                "labelCity" => $labelCity
            );

            array_push($employeeArr["body"], $e);
        }
        http_response_code(200);
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>