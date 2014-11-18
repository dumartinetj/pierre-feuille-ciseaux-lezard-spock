<?php

/*
 * Classe Manche
 */

require_once 'Modele.php';
require_once 'Coup.php';

class Manche extends Modele{

    public static function ajoutManche($idP) {
        try {
            $req = self::$pdo->prepare('INSERT INTO pfcls_Manches (idPartie) VALUES ('.$idP.')');
            $req->execute();
            return self::$pdo->lastInsertId(); //retourne le dernier id insérer dans la BDD sur cette session
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de l'insertion de la manche dans la base de données";
        }
    }

  public static function ajoutListeCoup($data) {
    try {
        $req = self::$pdo->prepare('UPDATE pfcls_Manches SET listeCoups=:listeCoups WHERE idManche=:idManche');
        $req->execute($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $messageErreur="Erreur lors de l'insertion du coup dans la liste de coups de la manche dans la base de données";
    }
        }

    public static function updateListeCoup($data) {
        try {
            $req = self::$pdo->prepare("UPDATE pfcls_Manches SET listeCoups = CONCAT(listeCoups,',','".$data['listeCoups']."') WHERE idManche=".$data['idManche']);
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la MAJ de la liste de coups de la manche dans la base de données";
        }
            }

    public static function setGagnantManche($data){
        try {
          $req = self::$pdo->prepare('UPDATE pfcls_Manches SET idJoueurGagnant=:idJoueurGagnant WHERE idManche=:idManche');
          $req->execute($data);
        } catch (PDOException $e) {
          echo $e->getMessage();
          $messageErreur="Erreur lors de l'insertion du joueur gagnant de la manche dans la base de données";
        }
    }

    public static function getIDJoueurGagnant($idM) {
        try {
            $req = self::$pdo->prepare('SELECT idJoueurGagnant FROM pfcls_Manches WHERE idManche='.$idM);
            $req->execute();
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                return $data_recup->idJoueurGagnant;
             }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la récup de l'id joueur gagnant de la manche dans la base de données";
        }
    }

    public static function getListeCoups($idM) {
        try {
            $req = self::$pdo->prepare('SELECT listeCoups FROM pfcls_Manches WHERE idManche='.$idM);
            $req->execute();
            if ($req->rowCount() != 0) {
                 $data_recup = $req->fetch(PDO::FETCH_OBJ);
                 $listeCoups = explode(",",$data_recup->listeCoups);
                 return $listeCoups;
             }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de récupération de la liste des coups de la manche dans la base de données";
        }
    }

  /*
   * Retourne la chaine de caractère correspondant à liste des coups de la manche passé en param
   * @param id de la manche
   * @return retourne la chaine de caractères
   */
   public static function parsageListeCoups($idM) {
        $chaineListeCoups = "";
        $listeCoups = static::getListeCoups($idM);
        foreach ($listeCoups as $coup) {
			       $chaineListeCoups .= Coup::retourneIDs($coup);
			       $chaineListeCoups .= ",";
		    }
        return $chaineListeCoups;
   }

}

?>
