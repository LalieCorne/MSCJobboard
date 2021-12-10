<?php
    include('../../controler/import-head.controler.php');


    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);

    $request = $_POST;

    $arrayJsonData= array();

    if(isset($request['objet']) && $request['objet'] != "")
    {
        $obj = 'obj'.$request['objet'];
        if(isset($request['id'])) {
            $obj = new $request['objet']($pCon->getInstance(), $request['id']);
            $obj->getById($request['id']);
            var_dump($obj);
        } else {
            $obj = new $request['objet']($pCon->getInstance());
        }
    }

    $resultJson = json_encode($obj->getJsonData($obj));
    print $resultJson;

?>