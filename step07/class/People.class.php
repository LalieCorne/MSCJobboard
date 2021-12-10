<?php
	require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class People{

        use getSetVal, populate, jsonData;

        private $__pCon;

        protected $id_people = null;
        protected $first_name = '';
        protected $last_name = '';
        protected $email = '';
        protected $password = '';

        public function __construct($pCon = null,$id_people = null)
        {
            $this->__pCon = $pCon;
            if(!is_null($id_people)){
                $this->id_people = $id_people;
                $this->getById($id_people);
            }
        }


        public function save()
        {
            $query = $this->__pCon->prepare(
                    "INSERT INTO people (
                        id_people,
                        first_name,
                        last_name,
                        email,
                        password
                    )
                    VALUES(
                        :id_people,
                        :first_name,
                        :last_name,
                        :email,
                        :password
                    )
                    ON DUPLICATE KEY UPDATE
                        first_name = :first_name,
                        last_name = :last_name,
                        email = :email,
                        password = :password
                    ");
            $query->bindValue('id_people', $this->id_people!=null||$this->id_people!=''?$this->id_people:null, PDO::PARAM_INT);
            $query->bindValue('first_name', htmlspecialchars(trim($this->first_name)), PDO::PARAM_STR);
            $query->bindValue('descrition', htmlspecialchars(trim($this->descrition)), PDO::PARAM_STR);
            $query->bindValue('email', $this->email!=null||$this->email!=''?$this->email:null, PDO::PARAM_STR);
            $query->bindValue('password', $this->password, PDO::PARAM_STR);
            //password_hash($this->password)
            try {
                $query->execute();
                if(!is_null($this->id_people) && $this->id_people != '') {
                    $return = $this->id_people;
                } else {
                    $return = $this->__pCon->lastInsertId();
                }
                
                return $return;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getById($id_people){
            $query = $this->__pCon->prepare("
                            SELECT *
                            FROM `people` b
                                WHERE id_people = :id_people");
                            
            $query->bindValue('id_people', $id_people,PDO::PARAM_INT);
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

        public function delete($id_people = null){
            $query = $this->__pCon->prepare(
                "DELETE FROM `people` WHERE `id_people` = :id_people LIMIT 1");
            $query->bindValue('id_people', $id_people, PDO::PARAM_INT);
            try {
                $query->execute();
                return 'People correctement supprimer';
                    
            } catch (Exception $e) {
                return 'Erreur People delete: ' . $e->getMessage();
            }
        }


        public function userLogin($email, $mdp){
            $query = $this->__pCon->prepare("SELECT password, id_people FROM people WHERE email = :email");
            $query->bindValue('email', htmlspecialchars(trim($email)),PDO::PARAM_STR);
            try {
                $query->execute();
                $result = $query->fetch();
                
            } catch (Exception $e) {
                return('Erreur People getUserByLogin : ' . $e->getMessage());
            }
    
            if(password_verify($mdp,$result['password'])){
                $this->getById($result['id_people']);
                return true;
            }else{
                return false;
            }
        }

        public function setMdp($password = null) {
            $query = $this->__pCon->prepare(
                "UPDATE people SET password = :password
                    WHERE id_people = :id_people");
                
            $query->bindValue('password', password_hash(trim($password), PASSWORD_BCRYPT), PDO::PARAM_STR);
            $query->bindValue('id_people', $this->id_people!=null||$this->id_people!=''?$this->id_people:null, PDO::PARAM_INT);
    
            try {
                $query->execute();
                return true;
                    
            } catch (Exception $e) {
                die('Erreur People setMdp: ' . $e->getMessage());
            }
        }

    }


?>