<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class Advertisement{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_advertisement = null;
        protected $title = '';
        protected $description = '';
        protected $creation_date = '';
        protected $id_companies = null;
        protected $id_type = null;
        protected $id_city = null;
        protected $id_sector = null;

        protected $labelType = '';
        protected $labelSector = '';
        protected $labelCity = '';
        protected $labelCompanies = '';

        public function __construct($pCon = null,$id_advertisement = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_advertisement)){
                $this->id_advertisement = $id_advertisement;
                $this->getById($id_advertisement);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO advertisement (
                        id_advertisement,
                        title,
                        description,
                        creation_date,
                        id_companies,
                        id_type,
                        id_city,
                        id_sector
                    )
                    VALUES(
                        :id_advertisement,
                        :title,
                        :description,
                        :creation_date,
                        :id_companies,
                        :id_type,
                        :id_city,
                        :id_sector
                    )
                    ON DUPLICATE KEY UPDATE
                        title = :title,
                        description = :description,
                        creation_date = :creation_date,
                        id_companies = :id_companies,
                        id_type = :id_type,
                        id_city = :id_city,
                        id_sector = :id_sector
                    ");
            $query->bindValue('id_advertisement', $this->id_advertisement!=null||$this->id_advertisement!=''?$this->id_advertisement:null, PDO::PARAM_INT);
            $query->bindValue('title', htmlspecialchars(trim($this->title)), PDO::PARAM_STR);
            $query->bindValue('descrition', htmlspecialchars(trim($this->descrition)), PDO::PARAM_STR);
            $query->bindValue('creation_date', $this->creation_date!=null||$this->creation_date!=''?$this->creation_date:null, PDO::PARAM_STR);
            
            $query->bindValue('id_companies', $this->id_companies, PDO::PARAM_INT);
            $query->bindValue('id_type', $this->id_type, PDO::PARAM_INT);
            $query->bindValue('id_city', $this->id_city, PDO::PARAM_INT);
            $query->bindValue('id_sector', $this->id_sector, PDO::PARAM_INT);
            
            try {
                $query->execute();
                if(!is_null($this->id_advertisement) && $this->id_advertisement != '') {
                    $return = $this->id_advertisement;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_advertisement){
            $query = $this->__pCon->prepare("
                            SELECT *

                            FROM `advertisement` LEFT JOIN companies USING (id_companies)

                                LEFT JOIN type USING (id_type)
                                LEFT JOIN city USING (id_city)
                                LEFT JOIN sector USING (id_sector) 
                                WHERE id_advertisement = :id_advertisement");
                            
            $query->bindValue('id_advertisement', $id_advertisement,PDO::PARAM_INT);
            try{
                $query->execute();
                $result = $query->fetch();
                foreach($result as $name => $value) {
                    if(property_exists(get_class(),$name)) {
                        $this->{$name} = $value;
                    }
                }
                
                return true;

            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function delete($id_advertisement = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `advertisement` WHERE `id_advertisement` = :id_advertisement LIMIT 1");
            $query->bindValue('id_advertisement', $id_advertisement, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'Advertisement correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur Advertisement delete: ' . $e->getMessage();
            }
        }

    }


?>