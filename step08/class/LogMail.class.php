<?php
    class LogMail{

        // Connection
        private $conn;

        // Table
        private $db_table = "log_mail";

        public $id_log_mail = null;
        public $id_recipient = null;
        public $date = '0000-00-00 00:00:00';
        public $first_name_sender = '';
        public $last_name_sender = '';
        public $email_sender = '';
        public $tel_sender = '';
        public $obj = '';
        public $content = '';

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getall($id_companies = null){
            if($id_companies){
                $sqlQuery = "SELECT * FROM " . $this->db_table . "
                WHERE id_recipient = :id_companies";


            }else{
                $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            }
            $stmt = $this->conn->prepare($sqlQuery);

            if($id_companies){
                $id_companies=htmlspecialchars(strip_tags($id_companies));
                $stmt->bindValue(":id_companies", $id_companies, PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function create(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id_log_mail = :id_log_mail, 
                        id_recipient = :id_recipient, 
                        date = :date,
                        first_name_sender = :first_name_sender,
                        last_name_sender = :last_name_sender,
                        email_sender = :email_sender,
                        tel_sender = :tel_sender,
                        obj = :obj,
                        content = :content
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id_log_mail=htmlspecialchars(strip_tags($this->id_log_mail));
            $this->id_recipient=htmlspecialchars(strip_tags($this->id_recipient));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->first_name_sender=htmlspecialchars(strip_tags($this->first_name_sender));
            $this->last_name_sender=htmlspecialchars(strip_tags($this->last_name_sender));
            $this->email_sender=htmlspecialchars(strip_tags($this->email_sender));
            $this->tel_sender=htmlspecialchars(strip_tags($this->tel_sender));
            $this->obj=htmlspecialchars(strip_tags($this->obj));
            $this->content=htmlspecialchars(strip_tags($this->content));
        
            // bind data
            $stmt->bindValue(":id_log_mail", $this->id_log_mail, PDO::PARAM_INT);
            $stmt->bindValue(":id_recipient", $this->id_recipient, PDO::PARAM_INT);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":first_name_sender", $this->first_name_sender);
            $stmt->bindParam(":last_name_sender", $this->last_name_sender);
            $stmt->bindParam(":email_sender", $this->email_sender);
            $stmt->bindParam(":tel_sender", $this->tel_sender);
            $stmt->bindParam(":obj", $this->obj);
            $stmt->bindParam(":content", $this->content);
            
            if($stmt->execute()){
               return $this->conn->lastInsertId();
            }
            return false;
        }
    }


?>