<?php

require_once _CLASS_DIR_.'/trait.php';

class ConnexionBD{
	use getSetVal;
	/**
	 * Objet de connexion à la base de donnée
	 * @var PDO|NULL $instance
	 */
	protected $instance = NULL;
	/**
	 * Nom de la base de donnée
	 * @var string $bdd
	 */
	protected $bdd = '';
	/**
	 * Moteur de la base de donnée
	 * @var string $moteur
	 */
	protected $moteur = 'mysql';
	/**
	 * Adresse de l'hote
	 * @var string $hote
	 */
	protected $hote = '127.0.0.1';
	/**
	 * Nom d'utilisateur de connexion à la base de donnée
	 * @var string $login
	 */
	protected $login = 'root';
	/**
	 * Mot de passe de connexion à la base de donnée
	 * @var string $mdp
	 */
	protected $mdp = '123';
	
	/**
	 * On instancie la connection à la base de donnée
	 */
	public function __construct() {
	}

	public function connect(){
		try {
			$this->instance = new PDO($this->moteur.':host='.$this->hote.';dbname='.$this->bdd,$this->login,$this->mdp,
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
			
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		$this->instance->exec("SET CHARACTER SET utf8");
	}
	
	/**
	 * Accesseur à l'objet PDO
	 * @return PDO|NULL
	 */
	public function getInstance() {
		return $this->instance;
	}	
	
}
 
 ?>