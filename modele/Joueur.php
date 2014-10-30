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
	
    // vérifier si l'utilisateur est connecté
    public static function estConnecte() {
            return isset($_SESSION['idJoueur']);
    }	

    public static function connexion($data) {
        if((Joueur::checkExisteConnexion($data))) {
            try {
                $data['pwd'] = sha1($data['pwd']);
                $req = self::$pdo->prepare('SELECT idJoueur FROM pfcls_Joueurs WHERE pseudo = :pseudo AND pwd = :pwd');
                $req->execute($data);
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    session_start();
                    $_SESSION['idJoueur'] = $data_recup->idJoueur;
                }
            }catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la connexion d'un utilisateur");
            }
        }
        else {
            die("Erreur pseudo ou mot de passe erroné"); // gestion des erreurs à améliorer
        }
    }
    
    public function seDeconnecter(){
        session_unset();
        session_destroy();
    }

    public static function checkExisteConnexion($data) {
        try {
            $data['pwd'] = sha1($data['pwd']);
            $req = self::$pdo->prepare('SELECT idJoueur FROM pfcls_Joueurs WHERE pseudo = :pseudo AND pwd = :pwd');
            $req->execute($data);
            return ($req->rowCount() != 0);
        }  catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la recherche utilisateur dans BDD pour connexion");
        }
    }
	
	
    public static function inscription($data) {
        if(!(Joueur::checkAlreadyExist($data))) {
            try {
                $data['pwd'] = sha1($data['pwd']);
                $req = self::$pdo->prepare('INSERT INTO pfcls_Joueurs (pseudo, sexe, age, pwd, email) VALUES (:pseudo, :sexe, :age, :pwd, :email) ');
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de l'insertion d'un utilisateur dans la BDD");
            }
        }
        else {
            die("Erreur pseudo/email existe déjà"); // gestion des erreurs à améliorer
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

	
	 public static function delete($data) {
        try {
            // Preparation de la requete
            $req = self::$pdo->prepare('DELETE FROM pfcls_joueurs WHERE pfcls_joueurs.pseudo = :pseudo');
            // execution de la requete
            $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('Erreur lors de la recherche d\'un joueur dans la BDD pfcls_joueurs');
        }
    }
	
	 public static function select($data) {
        try {
            // Preparation de la requete
            $req = self::$pdo->prepare('SELECT * FROM pfcls_joueurs WHERE pfcls_joueurs.pseudo = :pseudo');
            // execution de la requete
            $req->execute($data);

            if ($req->rowCount() != 0)
                return $req->fetch(PDO::FETCH_OBJ);
            return null;  // Optionel : si return est omis, Php envoie null dans tous les cas
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('Erreur lors de la recherche d\'un joueur dans la BDD pfcls_joueurs');
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
