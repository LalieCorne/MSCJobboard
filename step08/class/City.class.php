<?php
    class City{

        // Connection
        private $conn;

        // Table
        private $db_table = "city";

        protected $id_city = null;
        protected $label = '';
        protected $zip_code = 0;

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