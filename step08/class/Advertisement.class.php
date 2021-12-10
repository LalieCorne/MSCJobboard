<?php

    class Advertisement{

        // Connection
        private $conn;

        // Table
        private $db_table = "advertisement";

        public $id_advertisement = null;
        public $title = '';
        public $description = '';
        public $creation_date = null;
        public $id_companies = null;
        public $id_type = null;
        public $id_city = null;
        public $id_sector = null;
        public $id_people = null;

        public $labelType = '';
        public $labelSector = '';
        public $labelCity = '';
        public $labelCompanies = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getall($id_companies = null){
            if($id_companies == null){
                $sqlQuery = "SELECT a.*, t.label as labelType, 
                c.label as labelCity, s.label as labelSector
                FROM " . $this->db_table . " a
                    INNER JOIN companies USING (id_companies)
                    LEFT JOIN type t USING (id_type)
                    LEFT JOIN city c ON c.id_city = a.id_city 
                    LEFT JOIN sector s ON s.id_sector = a.id_sector";
                $stmt = $this->conn->prepare($sqlQuery);
            }else{
                $sqlQuery = "SELECT a.*, t.label as labelType, 
                c.label as labelCity, s.label as labelSector
                FROM " . $this->db_table . " a
                    INNER JOIN companies USING (id_companies)
                    LEFT JOIN type t USING (id_type)
                    LEFT JOIN city c ON c.id_city = a.id_city 
                    LEFT JOIN sector s ON s.id_sector = a.id_sector
                    WHERE a.id_companies = :id_companies";
                $stmt = $this->conn->prepare($sqlQuery);

                $id_companies=htmlspecialchars(strip_tags($id_companies));
                $stmt->bindParam(":id_companies", $id_companies);

            }
            
            $stmt->execute();
            return $stmt;
        }


        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_advertisement = :id_advertisement, 
                        title = :title, 
                        creation_date = :creation_date,
                        description = :description,
                        id_people = :id_people,
                        id_city = :id_city,
                        id_type = :id_type,
                        id_companies = :id_companies,
                        id_sector = :id_sector
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_advertisement=htmlspecialchars(strip_tags($this->id_advertisement));
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->id_city=htmlspecialchars(strip_tags($this->id_city));
            $this->id_type=htmlspecialchars(strip_tags($this->id_type));
            $this->id_sector=htmlspecialchars(strip_tags($this->id_sector));
            $this->id_companies=htmlspecialchars(strip_tags($this->id_companies));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
        
            // bind data
            $stmt->bindValue(":id_advertisement", $this->id_advertisement, PDO::PARAM_INT);
            $stmt->bindParam(":title", $this->title);
            $stmt->bindValue(":creation_date", ($this->creation_date != '' || $this->creation_date != null)? $this->creation_date : null);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":id_city", $this->id_city);
            $stmt->bindParam(":id_type", $this->id_type);
            $stmt->bindParam(":id_sector", $this->id_sector);
            $stmt->bindParam(":id_companies", $this->id_companies);
            $stmt->bindParam(":id_people", $this->id_people);
            
            if($stmt->execute()){
               return $this->conn->lastInsertId();
            }
            return false;
        }

    }


?>