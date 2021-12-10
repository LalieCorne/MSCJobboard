<?php
    class Companies{

        // Connection
        private $conn;

        // Table
        private $db_table = "companies";

        public $id_companies = null;
        public $name = '';
        public $email = '';
        public $phone = '';
        public $description = '';
        public $creation_date = '';
        public $id_people = null;
        public $id_city = null;
        public $id_sector = null;
        public $activate = 1;

        public $labelSector = '';
        public $labelCity = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getall(){
            $sqlQuery = "SELECT c.*, ci.label as labelCity, s.label as labelSector FROM " . $this->db_table . " c
            LEFT JOIN sector s ON c.id_sector = s.id_sector
            LEFT JOIN city ci ON c.id_city = ci.id_city";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }


        // READ single
        public function getSingle(){
            $sqlQuery = "SELECT
                        c.*, ci.label as labelCity, s.label as labelSector 
                      FROM
                        ". $this->db_table ." c
                        LEFT JOIN sector s ON c.id_sector = s.id_sector
                        LEFT JOIN city ci ON c.id_city = ci.id_city
                    WHERE 
                       id_companies = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_companies);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_companies = $dataRow['id_companies'];
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->phone = $dataRow['phone'];
            $this->creation_date = $dataRow['creation_date'];
            $this->description = $dataRow['description'];
            $this->id_city = $dataRow['id_city'];
            $this->id_people = $dataRow['id_people'];
            $this->id_sector = $dataRow['id_sector'];
            $this->labelSector = $dataRow['labelSector'];
            $this->labelCity = $dataRow['labelCity'];

            
        }  

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_companies = :id_companies, 
                        name = :name, 
                        email = :email, 
                        phone = :phone, 
                        creation_date = :creation_date,
                        description = :description,
                        id_city = :id_city,
                        id_people = :id_people,
                        id_sector = :id_sector
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_companies=htmlspecialchars(strip_tags($this->id_companies));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->id_city=htmlspecialchars(strip_tags($this->id_city));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
            $this->id_sector=htmlspecialchars(strip_tags($this->id_sector));
        
            // bind data
            $stmt->bindValue(":id_companies", $this->id_companies, PDO::PARAM_INT);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":creation_date", $this->creation_date);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindValue(":id_city", $this->id_city, PDO::PARAM_INT);
            $stmt->bindValue(":id_people", $this->id_people, PDO::PARAM_INT);
            $stmt->bindValue(":id_sector", $this->id_sector, PDO::PARAM_INT);
        
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
                        name = :name, 
                        phone = :phone, 
                        email = :email, 
                        creation_date = :creation_date,
                        description = :description,
                        id_city = :id_city,
                        id_people = :id_people,
                        id_sector = :id_sector,
                        activate = :activate
                    WHERE 
                        id_companies = :id_companies";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id_companies=htmlspecialchars(strip_tags($this->id_companies));
            $this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->id_city=htmlspecialchars(strip_tags($this->id_city));
            $this->id_people=htmlspecialchars(strip_tags($this->id_people));
            $this->id_sector=htmlspecialchars(strip_tags($this->id_sector));
            $this->activate=htmlspecialchars(strip_tags($this->activate));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id_companies", $this->id_companies);
            $stmt->bindParam(":creation_date", $this->creation_date);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":id_city", $this->id_city);
            $stmt->bindParam(":id_people", $this->id_people);
            $stmt->bindParam(":id_sector", $this->id_sector);
            $stmt->bindParam(":activate", $this-> activate);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

    }


?>