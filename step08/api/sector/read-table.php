<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/Sector.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $items = new Sector($db);

    $stmt = $items->getAll();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["data"] = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $str =  '
            <button data-id="'.$id_sector.'" class="green_button modify-button" type="button" data-bs-toggle="modal" data-bs-target="#modifyModal">
                <img class="img"
                    src="http://127.0.0.1:3000/public/assets/img/icon/svg/003-edit-button.png"
                    alt="Modify button">
            </button>
            <button data-id="'.$id_sector.'" class="green_button delete-button" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <img class="img"
                    src="http://127.0.0.1:3000/public/assets/img/icon/svg/001-delete.png"
                    alt="Delete button">
            </button>';

            

            $employeeArr["data"][]=[$label,$label_parent,$str,''];
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