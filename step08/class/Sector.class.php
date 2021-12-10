<?php
    class Sector{

        // Connection
        private $conn;

        // Table
        private $db_table = "sector";

        public $id_sector = null;
        public $label = '';
        public $id_sector_parent = '';
        public $label_parent = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getall(){
            $sqlQuery = "SELECT s.*, ss.label as label_parent FROM " . $this->db_table . " s 
            LEFT JOIN sector ss ON s.id_sector_parent = ss.id_sector";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_sector = :id_sector, 
                        id_sector_parent = :id_sector_parent, 
                        label = :label
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_sector=htmlspecialchars(strip_tags($this->id_sector));
            $this->id_sector_parent=htmlspecialchars(strip_tags($this->id_sector_parent));
            $this->label=htmlspecialchars(strip_tags($this->label));
        
            // bind data
            $stmt->bindValue(":id_sector", $this->id_sector, PDO::PARAM_INT);
            $stmt->bindValue(":id_sector_parent", ($this->id_sector_parent == '')?null:$this->id_sector_parent, PDO::PARAM_INT);
            $stmt->bindParam(":label", $this->label);
            
            if($stmt->execute()){
               return $this->conn->lastInsertId();
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
                       id_sector = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id_sector);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_sector = $dataRow['id_sector'];
            $this->label = $dataRow['label'];
            $this->id_sector_parent = $dataRow['id_sector_parent'];
        }

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        label = :label, 
                        id_sector_parent = :id_sector_parent
                    WHERE 
                        id_sector = :id_sector";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id_sector=htmlspecialchars(strip_tags($this->id_sector));
            $this->label=htmlspecialchars(strip_tags($this->label));
            $this->id_sector_parent=htmlspecialchars(strip_tags($this->id_sector_parent));
        
            // bind data
            $stmt->bindParam(":id_sector", $this->id_sector);
            $stmt->bindParam(":label", $this->label);
            $stmt->bindParam(":id_sector_parent", $this->id_sector_parent);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_sector = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id_sector));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }


?>