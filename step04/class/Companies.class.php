<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class Companies{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_companies = null;
        protected $name = '';
        protected $email = '';
        protected $phone = '';
        protected $description = '';
        protected $creation_date = '';
        protected $id_people = null;
        protected $id_city = null;
        protected $id_sector = null;

        public function __construct($pCon = null,$id_companies = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_companies)){
                $this->id_companies = $id_companies;
                $this->getById($id_companies);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO companies (
                        id_companies,
                        name,
                        email,
                        phone,
                        description,
                        creation_date,
                        id_people,
                        id_city,
                        id_sector
                    )
                    VALUES(
                        :id_companies,
                        :name,
                        :email,
                        :phone,
                        :description,
                        :creation_date,
                        :id_people,
                        :id_city,
                        :id_sector
                    )
                    ON DUPLICATE KEY UPDATE
                        name = :name,
                        email = :email,
                        phone = :phone,
                        description = :description,
                        creation_date = :creation_date,
                        id_people = :id_people,
                        id_city = :id_city,
                        id_sector = :id_sector
                    ");
            $query->bindValue('id_companies', $this->id_companies!=null||$this->id_companies!=''?$this->id_companies:null, PDO::PARAM_INT);
            $query->bindValue('name', htmlspecialchars(trim($this->name)), PDO::PARAM_STR);
            $query->bindValue('email', htmlspecialchars(trim($this->email)), PDO::PARAM_STR);
            $query->bindValue('phone', htmlspecialchars(trim($this->phone)), PDO::PARAM_STR);
            $query->bindValue('description', htmlspecialchars(trim($this->description)), PDO::PARAM_STR);
            $query->bindValue('creation_date', $this->creation_date!=null||$this->creation_date!=''?$this->creation_date:null, PDO::PARAM_STR);
            
            $query->bindValue('id_people', $this->id_people, PDO::PARAM_INT);
            $query->bindValue('id_city', $this->id_city, PDO::PARAM_INT);
            $query->bindValue('id_sector', $this->id_sector, PDO::PARAM_INT);
            
            try {
                $query->execute();
                if(!is_null($this->id_companies) && $this->id_companies != '') {
                    $return = $this->id_companies;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_companies){
            $query = $this->__pCon->prepare("
                            SELECT *
                            FROM `companies`
                                WHERE id_companies = :id_companies");
                            
            $query->bindValue('id_companies', $id_companies,PDO::PARAM_INT);
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

        public function delete($id_companies = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `companies` WHERE `id_companies` = :id_companies LIMIT 1");
            $query->bindValue('id_companies', $id_companies, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'Companies correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur Companies delete: ' . $e->getMessage();
            }
        }

    }


?>