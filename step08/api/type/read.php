<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/Type.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $items = new Type($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();

    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $returnArr = array();
        $returnArr["body"] = array();
        $returnArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_type" => $id_type,
                "label" => $label
            );

            array_push($returnArr["body"], $e);
        }
        http_response_code(200);
        echo json_encode($returnArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>