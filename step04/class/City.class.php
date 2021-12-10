<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class City{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_city = null;
        protected $label = '';
        protected $zip_code = 0;

        public function __construct($pCon = null,$id_city = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_city)){
                $this->id_city = $id_city;
                $this->getById($id_city);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO city (
                        id_city,
                        label,
                        zip_code
                    )
                    VALUES(
                        :id_city,
                        :label,
                        :zip_code
                    )
                    ON DUPLICATE KEY UPDATE
                        label = :label,
                        zip_code = :zip_code
                    ");
            $query->bindValue('id_city', $this->id_city!=null||$this->id_city!=''?$this->id_city:null, PDO::PARAM_INT);
            $query->bindValue('label', htmlspecialchars(trim($this->label)), PDO::PARAM_STR);
            $query->bindValue('zip_code', $this->zip_code, PDO::PARAM_INT);
            
            try {
                $query->execute();
                if(!is_null($this->id_city) && $this->id_city != '') {
                    $return = $this->id_city;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_city){
            $query = $this->__pCon->prepare("
                            SELECT *
                            FROM `city` b
                                WHERE id_city = :id_city");
                            
            $query->bindValue('id_city', $id_city,PDO::PARAM_INT);
            try{
                $query->execute();
                $result = $query->fetch();
                foreach($result as $label => $value) {
                    if(property_exists(get_class(),$label)) {
                        $this->{$label} = $value;
                    }
                }
                
                return true;

            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function delete($id_city = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `city` WHERE `id_city` = :id_city LIMIT 1");
            $query->bindValue('id_city', $id_city, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'City correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur City delete: ' . $e->getMessage();
            }
        }

    }


?>