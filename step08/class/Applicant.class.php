<?php

    class Applicant{

        // Connection
        private $conn;

        // Table
        private $db_table = "applicant";

        public $id_applicant = null;
        public $phone = '';
        public $profil_picture = '';
        public $description = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getall(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_applicant = :id_applicant, 
                        phone = :phone, 
                        profil_picture = :profil_picture,
                        description = :description
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_applicant=htmlspecialchars(strip_tags($this->id_applicant));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->profil_picture=htmlspecialchars(strip_tags($this->profil_picture));
            $this->description=htmlspecialchars(strip_tags($this->description));
        
            // bind data
            $stmt->bindValue(":id_applicant", $this->id_applicant, PDO::PARAM_INT);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":profil_picture", $this->profil_picture);
            $stmt->bindParam(":description", $this->description);
            
            if($stmt->execute()){
               return $this->conn->lastInsertId();
            }
            return false;
        }


    }


?>