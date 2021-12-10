<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/People.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    $items = new People($db);

    $stmt = $items->getAllAdmin();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["data"] = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            /*$e = array(
                "id_people" => $id_people,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email
            );

            array_push($employeeArr["body"], $e);*/

            // $employeeArr["data"][]=[$first_name." ".$last_name,$email,'
            // <button data_id="'.$id_people.'" class="green_button modify-button" type="button" data-bs-toggle="modal" data-bs-target="#modifyModal">
            //     <img class="img" src="http://127.0.0.1:3000/public/assets/img/icon/svg/003-edit-button.png"alt="Modify button">
            // </button>
            // <button data_id="'.$id_people.'" class="green_button delete-button" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
            //     <img class="img" src="http://127.0.0.1:3000/public/assets/img/icon/svg/001-delete.png" alt="Delete button">
            // </button>'];

            $str =  '
            <select data-id="'.$id_admin.'" class="js-example-basic-single form-control select-people">
                <option value="1"';
            ($activate_admin == 1) ? $str .='selected="selected"' : '';
            $str .= '>enable</option><option value="0"';
            ($activate_admin == 0) ? $str.='selected="selected"' : '';
            $str.='>disable</option></select>';
            $employeeArr["data"][]=[$first_name." ".$last_name,$email,"Admin",$str];
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