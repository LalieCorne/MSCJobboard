<?php
    class Admin{

        // Connection
        private $conn;

        // Table
        private $db_table = "admin";

        public $id_admin = null;
        public $phone = '';
        public $activate_admin = 0;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_admin = :id_admin, 
                        phone = :phone, 
                        activate_admin = :activate_admin
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_admin=htmlspecialchars(strip_tags($this->id_admin));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->activate=htmlspecialchars(strip_tags($this->activate_admin));
        
            // bind data
            $stmt->bindValue(":id_admin", $this->id_admin, PDO::PARAM_INT);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":activate_admin", $this->activate_admin);
            
            if($stmt->execute()){
               return $this->conn->lastInsertId();
            }
            return false;
        }

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        phone = :phone, 
                        activate_admin = :activate_admin
                    WHERE 
                        id_admin = :id_admin";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->activate_admin=htmlspecialchars(strip_tags($this->activate_admin));
            $this->id_admin=htmlspecialchars(strip_tags($this->id_admin));
        
            // bind data
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":activate_admin", $this->activate_admin);
            $stmt->bindParam(":id_admin", $this->id_admin);

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
                       id_admin = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_people);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            foreach($dataRow as $key => $value){
                $this->$key = $value;
            }
        } 
    }


?>
