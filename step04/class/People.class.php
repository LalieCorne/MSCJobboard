<?php
	//require_once (_ROOT_DIR_ADMIN_.'/class/trait.php');
    class People{

        //use getSetVal, populate, jsonData;

        // Connection
        private $conn;

        // Table
        private $db_table = "people";

        private $__pCon;

        public $id_people = null;
        public $first_name = '';
        public $last_name = '';
        public $email = '';
        public $password = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // public function __construct($pCon = null,$id_people = null)
        // {
        //     $this->__pCon = $pCon;
        //     if(!is_null($id_people)){
        //         $this->id_people = $id_people;
        //         $this->getById($id_people);
        //     }
        // }

        // GET ALL
        public function getall(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function save()
        {
            $sqlQuery = 
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
                    ";
            $stmt = $this->conn->prepare($sqlQuery);
            
            // sanitize
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
        
            // bind data
            $stmt->bindValue(":id_people", $this->id_people, PDO::PARAM_INT);
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", password_hash(trim($this->password), PASSWORD_BCRYPT));
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // public function getById($id_people){
        //     $query = $this->__pCon->prepare("
        //                     SELECT *
        //                     FROM `people` b
        //                         WHERE id_people = :id_people");
                            
        //     $query->bindValue('id_people', $id_people,PDO::PARAM_INT);
        //     try{
        //         $query->execute();
        //         $result = $query->fetch();
        //         foreach($result as $name => $value) {
        //             if(property_exists(get_class(),$name)) {
        //                 $this->{$name} = $value;
        //             }
        //         }
                
        //         return true;

        //     } catch (Exception $e) {
        //         return $e->getMessage();
        //     }
        // }

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_people = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id_people));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // READ single
        public function getSingle(){
            $sqlQuery = "SELECT
                        *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id_people = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_people);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_people = $dataRow['id_people'];
            $this->first_name = $dataRow['first_name'];
            $this->last_name = $dataRow['last_name'];
            $this->email = $dataRow['email'];
            $this->password = $dataRow['password'];
        }  

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        first_name = :first_name, 
                        last_name = :last_name, 
                        email = :email, 
                        password = :password
                    WHERE 
                        id_people = :id_people";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password= htmlspecialchars(strip_tags($this->password));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
        
            // bind data
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(":id_people", $this->id_people);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        
        // LOGGIN
        public function userLogin($email, $mdp){
            $sqlQuery = "SELECT password, id_people FROM people WHERE email = :email";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindValue('email', htmlspecialchars(trim($email)),PDO::PARAM_STR);
            
            if($stmt->execute()){
                $result = $stmt->fetch();
                if(password_verify($mdp,$result['password'])){
                    $this->id_people = $result['id_people'];
                    $this->getSingle();
                    return true;
                }else{
                    return false;
                }
            }
            return false;
    
            
        }

        // public function setMdp($password = null) {
        //     $query = $this->__pCon->prepare(
        //         "UPDATE people SET password = :password
        //             WHERE id_people = :id_people");
                
        //     $query->bindValue('password', password_hash(trim($password), PASSWORD_BCRYPT), PDO::PARAM_STR);
        //     $query->bindValue('id_people', $this->id_people!=null||$this->id_people!=''?$this->id_people:null, PDO::PARAM_INT);
    
        //     try {
        //         $query->execute();
        //         return true;
                    
        //     } catch (Exception $e) {
        //         die('Erreur People setMdp: ' . $e->getMessage());
        //     }
        // }

    }


?>