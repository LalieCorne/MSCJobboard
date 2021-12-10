<?php
$value = json_encode (array (
        "FirstName" => "Michel",
        "LastName" => "Potiron",
        "email" => "michel.potiron@abc.fr",
        "phone" => "0000000000",
        "files" => ['1','2','3']
    ));

echo $value;