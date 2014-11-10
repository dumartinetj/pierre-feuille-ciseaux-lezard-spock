<?php

/*
 * Classe Partie
 */
require_once 'Modele.php';
require_once 'Manche.php';

class Partie extends Modele {

    public static function getIDAdversaire($data) {
        try {
            $req = self::$pdo->prepare('SELECT idJoueur1, idJoueur2 FROM pfcls_Parties WHERE idJoueur1 = :idJoueur1 OR idJoueur2 = :idJoueur2');
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
            $req = self::$pdo->prepare('SELECT idPartie FROM pfcls_Parties WHERE idJoueur1 = :idJoueur1 AND idJoueur2 = :idJoueur2');
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
         if($jgm==$idJ){$nbVictoireJ1++;}
         elseif ($jgm==$idJA) {$nbVictoireJ2++;}
       }
       $nbMancheMini=static::getNbManches($idP);
       $nbMancheMini = $nbMancheMini/2;
       if(($nbVictoireJ1>$nbVictoireJ2)and($nbVictoireJ1>$nbMancheMini)){return true;}
       elseif (($nbVictoireJ1<$nbVictoireJ2)and($nbVictoireJ2>$nbMancheMini)) {return true;}
       return false;
  }

	/*
	 * Set et retourne le gagnant de this
	 * @return le gagnant de la partie
	 */
   public function getJoueurGagnantPartie(){
        $nbwinJ1=0;$nbwinJ2=0;
        foreach($this->listeManche as $lmanche){ //CHECK
            $jgm=$lmanche->getJoueurGagnantManche();
            if($jgm==$this->joueur1){$nbwinJ1++;}
            elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        }

        /*
        $jgm=end($this->listeManche)->getJoueurGagnantManche();
        if($jgm==$this->joueur1){$nbwinJ1++;}
        elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        while(prev($this->listeManche)!=FALSE){
            $jgm=current($this->listeManche)->getJoueurGagnantManche();
            if($jgm==$this->joueur1){$nbwinJ1++;}
            elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        }*/
        $nbMancheMini=$this->nbManche/2;
        if(($nbwinJ1>$nbwinJ2)and($nbwinJ1>$nbMancheMini)){$this->gagnantPartie=$this->joueur1;}
        elseif (($nbwinJ1<$nbwinJ2)and($nbwinJ2>$nbMancheMini)) {$this->gagnantPartie=$this->joueur2;}
        return $this->gagnantPartie;
    }

	/*
	 * Vérifie si la partie est terminée
	 * @return vraie si la partie est finie, faux sinon
	 */
    public function checkPartieFinie() {
	$nbmjoue=count($this->listeManche);
        $unGagnant=FALSE;
        if($nbmjoue>=1){
            $winner=$this->getJoueurGagnantPartie();
            $unGagnant=($winner!=NULL);
        }
        return (($this->nbManche==$nbmjoue) or $unGagnant);
    }
}

?>
