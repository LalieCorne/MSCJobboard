<?php
    class People{
        // Connection
        private $conn;

        // Table
        private $db_table = "people";

        public $id_people = null;
        public $first_name = '';
        public $last_name = '';
        public $email = '';
        public $password = '';
        public $activate = null;
        public $activate_admin = null;


        // Var people status
        public $id_companies = null;
        public $id_applicant = null;
        public $id_admin = null;

        // var applicant
        public $phone = '';
        public $profil_picture = '';
        public $description = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }


        // GET ALL
        public function getall(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " p 
            LEFT JOIN people_status ps ON p.id_people = ps.id_people";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL
        public function getallAdmin(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " p 
            LEFT JOIN people_status ps ON p.id_people = ps.id_people
            LEFT JOIN admin a ON ps.id_admin = a.id_admin
            WHERE ps.id_admin IS NOT NULL";
          
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


        // CREATE
        public function create(){
            $sqlQuery = "SELECT email FROM " . $this->db_table . " 
            WHERE email = :email";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(":email", $this->email);

            $stmt->execute();
            if(!$stmt->fetch(PDO::FETCH_ASSOC)){
                $sqlQuery = "INSERT INTO
                            ". $this->db_table ."
                        SET
                            id_people = :id_people, 
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
                $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
                
                if($stmt->execute()){
                    return $this->conn->lastInsertId();
                }
                return false;
            }else{
                return 'email already used';
            }
        }

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
                        ". $this->db_table ." p 
                        LEFT JOIN people_status ps ON p.id_people = ps.id_people 
                        LEFT JOIN applicant a ON ps.id_applicant = a.id_applicant 
                    WHERE 
                       p.id_people = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_people);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
   
            foreach($dataRow as $key => $value){
                $this->$key = $value;
            }

        }  

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        first_name = :first_name, 
                        last_name = :last_name, 
                        email = :email, 
                        password = :password,
                        activate = :activate
                    WHERE 
                        id_people = :id_people";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->first_name=htmlspecialchars(strip_tags($this->first_name));
            $this->last_name=htmlspecialchars(strip_tags($this->last_name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password= htmlspecialchars(strip_tags($this->password));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
            $this->activate=htmlspecialchars(strip_tags($this->activate));
        
            // bind data
            $stmt->bindParam(":first_name", $this->first_name);
            $stmt->bindParam(":last_name", $this->last_name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(":id_people", $this->id_people);
            $stmt->bindParam(":activate", $this->activate);

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
                    foreach($result as $key => $value){
                        $this->$key = $value;
                    }

                    return true;
                }else{
                    return false;
                }
            }
            return false;
    
            
        }
    }


?>