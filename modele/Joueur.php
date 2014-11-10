<?php

/*
 * Classe Joueur
 */

require_once 'Modele.php';
require_once 'Jeu.php';

class Joueur extends Modele {

    public static function connexion($data) {
        try {
            $data['pwd'] = sha1($data['pwd']);
            $req = self::$pdo->prepare('SELECT idJoueur, pseudo FROM pfcls_Joueurs WHERE pseudo = :pseudo AND pwd = :pwd');
            $req->execute($data);
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                $_SESSION['idJoueur'] = $data_recup->idJoueur;
                $_SESSION['pseudo'] = $data_recup->pseudo;
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Échec lors de la connexion d'un utilisateur";
        }
    }

    public static function deconnexion(){
        if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){
            Jeu::deleteAttente($_SESSION['idJoueur']);
        }
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
            $messageErreur="Erreur lors de la recherche dans la base de données checkConnexion";
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
                $messageErreur="Erreur lors de l'insertion dans la base de données pour inscription";
            }
        }
        else {
            $messageErreur="Pseudo ou email déjà existant";
        }
    }

    public static function checkAlreadyExist($data) {
      try {
              $var = "SELECT * FROM pfcls_Joueurs WHERE";
              if (estConnecte()) $var .= " idJoueur !=".$_SESSION['idJoueur']." AND";
              $var .= " (pseudo = :pseudo OR email = :email)";
              $req = self::$pdo->prepare($var);
              $req->execute(array('pseudo' => $data['pseudo'], 'email' => $data['email']));
              $data_recup = $req->fetch(PDO::FETCH_OBJ);
              return ($req->rowCount() != 0);
              }
           catch (PDOException $e) {
              echo $e->getMessage();
              $messageErreur="Erreur lors de la recherche d'un utilisateur dans la BDD pour le check pseudo/mail";
          }
    }

    public static function search($data) {
        try {
            $req = self::$pdo->prepare("SELECT * FROM pfcls_Joueurs WHERE pseudo = :pseudo");
            $req->execute($data);
            if ($req->rowCount() != 0)
                return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche d'un joueur dans la base de données";
        }
    }

    public static function updateProfil($data) {
        if(!(Joueur::checkAlreadyExist($data))) {
            try {
                $data['pwd'] = sha1($data['pwd']);
                $req = self::$pdo->prepare('UPDATE pfcls_joueurs SET pseudo= :pseudo, age= :age, pwd= :pwd, email= :email WHERE idJoueur='.$_SESSION['idJoueur']);
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la mise à jour d'un joueur dans la base de données";
            }
        }
        else{
            $messageErreur="Pseudo ou email déjà utilisé !";
        }
    }

    public static function deleteProfil() {
        try {
            $req = self::$pdo->prepare('DELETE FROM pfcls_Joueurs WHERE idJoueur ='.$_SESSION['idJoueur']);
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la suppression d'un joueur de la base de données";
        }
    }

    public static function getProfil() {
        try {
            $req = self::$pdo->prepare('SELECT * FROM pfcls_Joueurs WHERE idJoueur ='.$_SESSION['idJoueur']);
            $req->execute();
            return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche d'un joueur dans la base de données";
        }
    }

    public static function getPseudo($idJ) {
        try {
            $req = self::$pdo->prepare('SELECT pseudo FROM pfcls_Joueurs WHERE idJoueur ='.$idJ);
            $req->execute();
            $data_recup = $req->fetch(PDO::FETCH_OBJ);
            return $data_recup->pseudo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la recherche d'un joueur dans la base de données";
        }
    }

	public function getIdentifiant() {
		return $this->identifiant;
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
