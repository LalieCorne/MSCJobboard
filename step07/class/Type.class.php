<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class Type{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_type = null;
        protected $label = '';

        public function __construct($pCon = null,$id_type = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_type)){
                $this->id_type = $id_type;
                $this->getById($id_type);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO type (
                        id_type,
                        label
                    )
                    VALUES(
                        :id_type,
                        :label
                    )
                    ON DUPLICATE KEY UPDATE
                        label = :label
                    ");
            $query->bindValue('id_type', $this->id_type!=null||$this->id_type!=''?$this->id_type:null, PDO::PARAM_INT);
            $query->bindValue('label', htmlspecialchars(trim($this->label)), PDO::PARAM_STR);
            
            try {
                $query->execute();
                if(!is_null($this->id_type) && $this->id_type != '') {
                    $return = $this->id_type;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_type){
            $query = $this->__pCon->prepare("
                            SELECT *
                            FROM `type` b
                                WHERE id_type = :id_type");
                            
            $query->bindValue('id_type', $id_type,PDO::PARAM_INT);
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

        public function delete($id_type = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `type` WHERE `id_type` = :id_type LIMIT 1");
            $query->bindValue('id_type', $id_type, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'Type correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur Type delete: ' . $e->getMessage();
            }
        }

    }


?>