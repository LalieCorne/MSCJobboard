<?php

$strToEcho = '';

$objAdCollection = new AdvertisementCollection($pCon->getInstance());
$objAdCollection->getAll();
?>
