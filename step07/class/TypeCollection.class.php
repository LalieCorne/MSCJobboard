<?php

    require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');

    class TypeCollection {
        use getSetVal, jsonData;
        private $_pCon;

        public $arrayObj = array();
        
        public function __construct($pCon = null) {
            $this->_pCon = $pCon;
        }

        public function getAll(){
            $query = $this->_pCon->prepare("
                        SELECT *
                            FROM `type`
                        ");
            try {
                $query->execute();
                $result = $query->fetchAll();
                foreach($result as $k => $row) {
                    $obj = new Type($this->_pCon);
                    $obj->populate($row);
                    $this->arrayObj[] = $obj;
                }
            } catch (Exception $e) {
                return ('Erreur Type Collection getAll: ' . $e->getMessage());
            }
        }
    }
?>