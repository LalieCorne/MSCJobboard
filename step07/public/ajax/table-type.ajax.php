<?php

if(isset($_GET)) {
    foreach($_GET as $name => $var) {
        ${$name} = $var;
    }
}

$sql = 'CREATE TEMPORARY TABLE '.$table.' (
    SELECT cdc.*, 
    e.LABEL_ENSEIGNE, 
    g.LABEL_GROUPE
    FROM `gis_cahier_des_charges` cdc
    INNER JOIN gis_enseignes e USING(ID_ENSEIGNE)
    LEFT JOIN gis_groupe g USING(ID_GROUPE)
    WHERE cdc.ID_ENSEIGNE IS NOT NULL
    GROUP BY ID_CAHIER_DES_CHARGES ORDER BY ID_CAHIER_DES_CHARGES DESC)';

$SSPHelper = new SSPHelper();

$dataReturn = $SSPHelper->simple( $_GET, $pCon->getInstance(), $table, $primaryKey, $columns);

// foreach($dataReturn["data"] as $key => $value){
//     array_push($dataReturn["data"][$key], $str);
// }

echo (json_encode($dataReturn));