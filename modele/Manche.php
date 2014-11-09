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

  /*
   * Retourne la chaine de caractère correspondant à liste des coup de la manche this
   * @return retourne la chaine de caractère
   */
   public function parsageListeCoups() {
        $chaineListeCoup = "";
        foreach ($this->listeCoup as $coup) {
			$chaineListeCoup .= $coup->retourneIDs();
			$chaineListeCoup .= ",";
		}
        $chaineListeCoup=rtrim($chaineListeCoup,",");
        return $chaineListeCoup;
   }

  /*
   * Insére les stats globales dans la BDD de la manche this
   */
  public function ajoutStatsGlobales(){
      try {
		 $data = array(
            'idJoueur1' => $this->getIdJoueur1(),
            'idJoueur2' => $this->getIdJoueur2(),
            'listeCoups' => $this->parsageListeCoups()
        );
         $req = self::$pdo->prepare('INSERT INTO pfcls_StatistiquesGlobales (idJoueur1, idJoueur2, listeCoups) VALUES (:idJoueur1, :idJoueur2, :listeCoups)');
         $req->execute($data);
         Manche::ajoutStatsPersonnelles($data);
      } catch (PDOException $e) {
          echo $e->getMessage();
          die("Erreur lors de l'insertion des stats globales dans la BDD");
      }

  }

  /*
   * Parse les données globales en perso
   * @param un tableau contenant les données globales
   * @return un tableau contenant les données perso parsées, prêtent à être stocker
   */
  public static function parsageStatsPerso($data){

                $lcj1 = "";
                $lcj2 = "";
                $tabCoupleCoup = explode(",",$data['listeCoups']);
				foreach ($tabCoupleCoup as $couple) {
					$lcj1 .= $couple[0].",";
					$lcj2 .= $couple[1].",";
                }
				$lcj1=rtrim($lcj1,",");
				$lcj2=rtrim($lcj2,",");
				$data_new = array(
					'idJoueur1' => $data['idJoueur1'],
					'listeCoupsJ1' => $lcj1,
					'idJoueur2' => $data['idJoueur2'],
					'listeCoupsJ2' => $lcj2
				);
				return $data_new;

  }

   /*
   * Insére les stats perso dans la BDD à partir de données globales
   * @param un tableau contenant les données globales
   */
  public static function ajoutStatsPersonnelles($data){
      try {
		 $data_new = Manche::parsageStatsPerso($data);
         $req = self::$pdo->prepare('INSERT INTO pfcls_StatistiquesPersonnelles (idJoueur, listeCoups) VALUES (:idJoueur1, :listeCoupsJ1)');
         $req->execute(array('idJoueur1' => $data_new['idJoueur1'], 'listeCoupsJ1' => $data_new['listeCoupsJ1']));
		 $req2 = self::$pdo->prepare('INSERT INTO pfcls_StatistiquesPersonnelles (idJoueur, listeCoups) VALUES (:idJoueur2, :listeCoupsJ2)');
         $req2->execute(array('idJoueur2' => $data_new['idJoueur2'], 'listeCoupsJ2' => $data_new['listeCoupsJ2']));
      } catch (PDOException $e) {
          echo $e->getMessage();
          die("Erreur lors de l'insertion des stats personnelles dans la BDD");
      }

  }

}

?>
