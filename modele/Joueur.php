<?php

/*
 * Classe Joueur
 */
 
require_once 'Modele.php';

class Joueur extends Modele {

    private $identifiant;
    private $pseudo;
    private $sexe;
	private $age;
	private $nbVictoire;
	private $nbDefaite;
	private $password;
	private $email;

	/*
	 * Constructeur de la classe qui instancie un nouveau Joueur
	 */
    public function __construct($i, $p, $s, $a, $pw, $em) {
        $this->identifiant = $i;
        $this->pseudo = $p;
        $this->sexe = $s;
		    $this->age = $a;
		    $this->nbVictoire = 0;
		    $this->nbDefaite = 0;
		    $this->password = $pw;
		    $this->email = $em;
    }

    public static function inscription($data) {
      if(!(Joueur::checkAlreadyExist($data))) {
          try {
               $data['pwd'] = sha1($data['pwd']);
			   var_dump($data);
               $req = self::$pdo->prepare('INSERT INTO pfcls_Joueurs (pseudo, sexe, age, nbV, nbD, pwd, email) VALUES (:pseudo, :sexe, :age, :nbV, :nbD, :pwd, :email) ');
               var_dump($req);
			   $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de l'insertion d'un utilisateur dans la BDD");
          }
      }
      else {
        return "Erreur pseudo/email existe déjà"; // gestion des erreurs à améliorer
      }
    }

    public static function checkAlreadyExist($data) {
      try {
              $req = self::$pdo->prepare("SELECT * FROM pfcls_Joueurs WHERE pseudo = :pseudo OR email = :email");
              $req->execute(array('pseudo' => $data['pseudo'], 'email' => $data['email']));
              return ($req->rowCount() != 0);
              }
           catch (PDOException $e) {
              echo $e->getMessage();
              die("Erreur lors de la recherche d'un utilisateur dans la BDD pour le check inscription");
          }
    }

	public function getIdentifiant() {
		return $this->identifiant;
	}

	public function getPseudo() {
		return $this->pseudo;
	}

	public function getSexe() {
		return $this->sexe;
	}

	public function getAge() {
		return $this->age;
	}

	public function getNbVictoire() {
		return $this->nbVictoire;
	}

	public function getNbDefaite() {
		return $this ->nbDefaite;
	}

	public function getEmail() {
		return $this ->nbDefaite;
	}
}

?>
