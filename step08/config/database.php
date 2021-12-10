<?php 
    class Database {
        private $host = "127.0.0.1:3306";
        private $database_name = "jobboard";
        private $username = "root";
        private $password = "123456";

        public $conn;



/**
   * @var Singleton
   * @access private
   * @static
   */
  private static $_instance = null;
 
  /**
   * Constructeur de la classe
   *
   * @param void
   * @return void
   */
  private function __construct() {  
  }

  /**
   * Méthode qui crée l'unique instance de la classe
   * si elle n'existe pas encore puis la retourne.
   *
   * @param void
   * @return Singleton
   */
  public static function getInstance() {

    if(is_null(self::$_instance)) {
      self::$_instance = new Database();  
    }

    return self::$_instance;
  }



        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>