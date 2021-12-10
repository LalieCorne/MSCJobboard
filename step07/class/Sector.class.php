<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class Sector{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_sector = null;
        protected $label = '';
        protected $id_sector_parent = 0;

        public function __construct($pCon = null,$id_sector = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_sector)){
                $this->id_sector = $id_sector;
                $this->getById($id_sector);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO city (
                        id_sector,
                        label,
                        id_sector_parent
                    )
                    VALUES(
                        :id_sector,
                        :label,
                        :id_sector_parent
                    )
                    ON DUPLICATE KEY UPDATE
                        label = :label,
                        id_sector_parent = :id_sector_parent
                    ");
            $query->bindValue('id_sector', $this->id_sector!=null||$this->id_sector!=''?$this->id_sector:null, PDO::PARAM_INT);
            $query->bindValue('label', htmlspecialchars(trim($this->label)), PDO::PARAM_STR);
            $query->bindValue('id_sector_parent', $this->id_sector_parent, PDO::PARAM_INT);
            
            try {
                $query->execute();
                if(!is_null($this->id_sector) && $this->id_sector != '') {
                    $return = $this->id_sector;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_sector){
            $query = $this->__pCon->prepare("
                            SELECT *
                            FROM `city` b
                                WHERE id_sector = :id_sector");
                            
            $query->bindValue('id_sector', $id_sector,PDO::PARAM_INT);
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

        public function delete($id_sector = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `city` WHERE `id_sector` = :id_sector LIMIT 1");
            $query->bindValue('id_sector', $id_sector, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'City correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur City delete: ' . $e->getMessage();
            }
        }

    }


?>