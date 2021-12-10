<?php

    require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');

    class PeopleCollection {
        use getSetVal, jsonData;
        private $_pCon;

        public $arrayObj = array();
        
        public function __construct($pCon = null) {
            $this->_pCon = $pCon;
        }

        public function getAll(){
            $query = $this->_pCon->prepare("
                        SELECT *
                            FROM `people`
                        ");
            try {
                $query->execute();
                $result = $query->fetchAll();
                foreach($result as $k => $row) {
                    $obj = new People($this->_pCon);
                    $obj->populate($row);
                    $this->arrayObj[] = $obj;
                }
            } catch (Exception $e) {
                return ('Erreur People Collection getAll: ' . $e->getMessage());
            }
        }
    }
?>