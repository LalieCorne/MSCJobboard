<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/Companies.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $items = new Companies($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["data"] = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $str =  '
            <select data-id="'.$id_companies.'" class="js-example-basic-single form-control select-people">
                <option value="1"';
            ($activate == 1) ? $str .='selected="selected"' : '';
            $str .= '>enable</option><option value="0"';
            ($activate == 0) ? $str.='selected="selected"' : '';
            $str.='>disable</option></select>';

            $employeeArr["data"][]=[$name,$email,$labelSector,$str];
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