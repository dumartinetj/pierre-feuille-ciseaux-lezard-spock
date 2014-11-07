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
            $messageErreur="Erreur lors de l'insertion de la partie dans la base de données";
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

	/*
	 * Ajoute la manche passé en paramètre à listeManche de this
	 * @param $m la manche à ajouter

    public function ajoutManche($m) {
        array_push($this->listeManche, $m);
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
