<?php

    include('../../controler/import-head.controler.php');
    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    
    $request = $_POST;

    $arrayJsonData= array();

    if(isset($request['objet']) && $request['objet'] != "")
    {
        $obj = 'obj'.$request['objet'];

        $obj = new $request['objet']($pCon->getInstance(),$request['id']);


        foreach($request['propriete'] as $label => $value){
            $obj->setVal($label,$value);
        }
        
        $obj->save();
        
        $arrayJsonData[] = $obj->getJsonData($obj);
    }

    $resultJson = json_encode($arrayJsonData);
    print $resultJson;

?>