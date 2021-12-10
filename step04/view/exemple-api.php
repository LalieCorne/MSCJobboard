
<?php
$title = '';
include("../controler/import-head.controler.php");
include(_ROOT_DIR_ADMIN_."/controler/index.controler.php");
?>
<h1>un titre</h1>
<?php
    $objType = new Type($pCon->getInstance(),1);
    $objType->setVal('label','sageV2');

    $objType2 = new Type($pCon->getInstance());
    $objType2->setVal('label','alternace');
    
    $objType->save();
    $objType2->save();

    $objTypeCollection = new TypeCollection($pCon->getInstance());
    $objTypeCollection->getAll();
    var_dump($objTypeCollection);
    var_dump(password_hash('mdp', PASSWORD_BCRYPT));

?>
<?php
include(_ROOT_DIR_ADMIN_."/controler/import-foot.controler.php");
?>