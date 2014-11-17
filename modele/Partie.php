<?php

/*
 * Classe Partie
 */
require_once 'Modele.php';
require_once 'Manche.php';

class Partie extends Modele {

    public static function getIDAdversaire($data) {
        try {
            $req = self::$pdo->prepare('SELECT idJoueur1, idJoueur2 FROM pfcls_Parties WHERE idJoueurGagnant IS NULL AND (idJoueur1 = :idJoueur1 OR idJoueur2 = :idJoueur2)');
            $req->execute($data);
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                if ($data_recup->idJoueur1 == $data['idJoueur1']) {
                  return $data_recup->idJoueur2;
                }
                else {
                  return $data_recup->idJoueur1;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la récupération de l'ID adversaire de la partie de la partie dans la base de données";
        }
    }

    public static function getIDPartie($data) {
        try {
            $req = self::$pdo->prepare('SELECT idPartie FROM pfcls_Parties WHERE idJoueurGagnant IS NULL AND (idJoueur1 = :idJoueur1 AND idJoueur2 = :idJoueur2)');
            $req->execute($data);
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                  return $data_recup->idPartie;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la récupération de l'ID de la partie dans la base de données";
        }
    }

    public static function getIDJoueurGagnant($idP) {
        try {
            $req = self::$pdo->prepare('SELECT idJoueurGagnant FROM pfcls_Parties WHERE idPartie ='.$idP);
            $req->execute();
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                  return $data_recup->idJoueurGagnant;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la récupération de l'ID du joueur gagnant de la partie dans la base de données";
        }
    }

    public static function setIDJoueurGagnant($data) {
     try {
         $req = self::$pdo->prepare('UPDATE pfcls_Parties SET idJoueurGagnant=:idJoueurGagnant WHERE idPartie=:idPartie');
         $req->execute($data);
     } catch (PDOException $e) {
         echo $e->getMessage();
         $messageErreur="Erreur lors de la MAJ de l'idJoueurGagnant de la partie dans la base de données";
     }
         }

    public static function ajouterPartie($data) {
        try {
            $req = self::$pdo->prepare('INSERT INTO pfcls_Parties (nbManche, idJoueur1, idJoueur2) VALUES (:nbManche, :idJoueur1, :idJoueur2) ');
            $req->execute($data);
            return self::$pdo->lastInsertId(); //retourne le dernier id insérer dans la BDD sur cette session
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de l'insertion de la partie dans la base de données";
        }
    }

    public static function deletePartie($data) {
        try {
            $req = self::$pdo->prepare('DELETE FROM pfcls_Parties WHERE idPartie=:idPartie');
            $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la suppression de la partie dans la base de données";
        }
    }

	public static function ajoutListeManche($data) {
   try {
       $req = self::$pdo->prepare('UPDATE pfcls_Parties SET listeManches=:listeManches WHERE idPartie=:idPartie');
       $req->execute($data);
   } catch (PDOException $e) {
       echo $e->getMessage();
       $messageErreur="Erreur lors de l'insertion du coup dans la liste de manches de la partie dans la base de données";
   }
       }

   public static function updateListeManche($data) {
       try {
           $req = self::$pdo->prepare("UPDATE pfcls_Parties SET listeManches = CONCAT(listeManches,',','".$data['listeManches']."') WHERE idPartie=".$data['idPartie']);
           $req->execute();
       } catch (PDOException $e) {
           echo $e->getMessage();
           $messageErreur="Erreur lors de la MAJ de la liste de manches de la partie dans la base de données";
       }
   }

   public static function getListeManches($idP) {
       try {
           $req = self::$pdo->prepare('SELECT listeManches FROM pfcls_Parties WHERE idPartie='.$idP);
           $req->execute();
           if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                $listeManches = explode(",",$data_recup->listeManches);
                return $listeManches;
            }
       } catch (PDOException $e) {
           echo $e->getMessage();
           $messageErreur="Erreur lors de récupération de la liste des manches de la partie dans la base de données";
       }
   }

   public static function getNbManches($idP) {
       try {
           $req = self::$pdo->prepare('SELECT nbManche FROM pfcls_Parties WHERE idPartie='.$idP);
           $req->execute();
           if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                return $data_recup->nbManche;
            }
       } catch (PDOException $e) {
           echo $e->getMessage();
           $messageErreur="Erreur lors de récupération du nombre de manches de la partie dans la base de données";
       }
   }

   public static function estTerminee($idP, $idJ, $idJA) {
       $nbVictoireJ1 = 0;
       $nbVictoireJ2 = 0;
       $listeManches = static::getListeManches($idP);
       foreach($listeManches as $manche){
         $jgm = Manche::getIDJoueurGagnant($manche);
         if($jgm==$idJ){
           $nbVictoireJ1++;
         }
         elseif ($jgm==$idJA) {
           $nbVictoireJ2++;
         }
       }
       $nbMancheMini=static::getNbManches($idP);
       $nbMancheMini = $nbMancheMini/2;
       if(($nbVictoireJ1>$nbVictoireJ2)and($nbVictoireJ1>$nbMancheMini)){
         $data = array(
             "idPartie" => $idP,
             "idJoueurGagnant" => $idJ
         );
         Partie::setIDJoueurGagnant($data);
         return true;
       }
       elseif (($nbVictoireJ1<$nbVictoireJ2)and($nbVictoireJ2>$nbMancheMini)) {
         $data = array(
             "idPartie" => $idP,
             "idJoueurGagnant" => $idJA
         );
         Partie::setIDJoueurGagnant($data);
         return true;
       }
       return false;
  }

  public static function getResultat($idP, $idJ, $idJA) {
      $nbVictoireJ1 = 0;
      $nbVictoireJ2 = 0;
      $listeManches = static::getListeManches($idP);
      foreach($listeManches as $manche){
        $jgm = Manche::getIDJoueurGagnant($manche);
        if($jgm==$idJ){
          $nbVictoireJ1++;
        }
        elseif ($jgm==$idJA) {
          $nbVictoireJ2++;
        }
      }
      $resultat = array(
          "nbVictoireJ1" => $nbVictoireJ1,
          "nbVictoireJ2" => $nbVictoireJ2
      );
      return $resultat;
    }
}

?>
