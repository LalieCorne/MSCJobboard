<?php

    class People_status{

        // Connection
        private $conn;

        // Table
        private $db_table = "people_status";

        public $id_people_status = null;
        public $id_people = null;
        public $id_companies = null;
        public $id_applicant = null;
        public $id_admin = null;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_people_status = :id_people_status, 
                        id_people = :id_people, 
                        id_companies = :id_companies, 
                        id_applicant = :id_applicant,
                        id_admin = :id_admin
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_people_status=htmlspecialchars(strip_tags($this->id_people_status));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
            $this->id_companies=htmlspecialchars(strip_tags($this->id_companies));
            $this->id_applicant=htmlspecialchars(strip_tags($this->id_applicant));
            $this->id_admin=htmlspecialchars(strip_tags($this->id_admin));
        
            // bind data
            $stmt->bindValue(":id_people_status", $this->id_people_status, PDO::PARAM_INT);
            $stmt->bindValue(":id_people", $this->id_people, PDO::PARAM_INT);
            $stmt->bindValue(":id_companies", $this->id_companies, PDO::PARAM_INT);
            $stmt->bindValue(":id_applicant", $this->id_applicant, PDO::PARAM_INT);
            $stmt->bindValue(":id_admin", $this->id_admin, PDO::PARAM_INT);
            
            if($stmt->execute()){
               return true;
            }
            return false;
        }


    }


?>