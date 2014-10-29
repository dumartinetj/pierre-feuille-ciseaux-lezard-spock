<?php

/*
 * Classe Joueur
 */

class Joueur extends Modele{

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
    public function __construct($i, $p, $s, $a, $em, $pw) {
        $this->identifiant = $i;
        $this->pseudo = $p;
        $this->sexe = $s;
		$this->age = $a;
		$this->nbVictoire = 0;
		$this->nbDefaite = 0;		
		$this->password = $pw;		
		$this->email = $em;		
    }
    public static function insert($data) {
        try {
            $req = self::$pdo->prepare('INSERT INTO joueur (idJoueur, pseudo, sexe, age, nbV, nbD, passw, email) VALUES (:idJoueur, :pseudo, :sexe, :age, :nbV, :nbD, :passw :email)');
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('Erreur lors de l\'insertion dans la BDD joueur');
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