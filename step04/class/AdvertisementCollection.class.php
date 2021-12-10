<?php

    require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');

    class AdvertisementCollection {
        use getSetVal, jsonData;
        private $_pCon;

        public $arrayObj = array();
        
        public function __construct($pCon = null) {
            $this->_pCon = $pCon;
        }

        public function getAll(){
            $query = $this->_pCon->prepare("
                        SELECT advertisement.*, SUBSTR(advertisement.description, 1, 143) as description,
                            companies.name as labelCompanies 
                            FROM `advertisement` INNER JOIN companies USING (id_companies)
                        ORDER BY advertisement.creation_date DESC
                        ");
            try {
                $query->execute();
                $result = $query->fetchAll();
                foreach($result as $k => $row) {
                    $obj = new Advertisement($this->_pCon);
                    $obj->populate($row);
                    $this->arrayObj[] = $obj;
                }
            } catch (Exception $e) {
                return ('Erreur Advertisement Collection getAll: ' . $e->getMessage());
            }
        }
    }
?>