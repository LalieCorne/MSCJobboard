<?php

    class Type{

        // Connection
        private $conn;

        // Table
        private $db_table = "type";

        public $id_sector = null;
        public $label = '';

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

    }


?>