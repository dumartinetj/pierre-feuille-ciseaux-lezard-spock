<?php

/*
 * Classe Joueur
 */

require_once 'Modele.php';
require_once 'Jeu.php';
require_once 'StatsPerso.php';

class Joueur extends Modele {

  protected static $table = "pfcls_Joueurs";
  protected static $primary_index = "idJoueur";

    public static function connexion($data) {
        $_SESSION['idJoueur'] = $data['idJoueur'];
        $_SESSION['pseudo'] = $data['pseudo'];
    }

    public static function deconnexion(){
        session_unset();
        session_destroy();
    }

    public static function updateNbVictoire($idJ) {
            try {
                $req = self::$pdo->prepare('UPDATE pfcls_Joueurs SET nbV=nbV+1 WHERE idJoueur='.$idJ);
                $req->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la mise à jour du nb de victoire d'un joueur dans la base de données";
            }
    }

    public static function updateNbDefaite($idJ) {
            try {
                $req = self::$pdo->prepare('UPDATE pfcls_Joueurs SET nbD=nbD+1 WHERE idJoueur='.$idJ);
                $req->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la mise à jour du nb de défaite d'un joueur dans la base de données";
            }
    }

    public static function getRatio($nbv,$nbd){
      $r = 0;
      if($nbv==0 && $nbd!=0) $r = 0;
      if($nbv!=0 && $nbd==0) {
        $r = $nbv;
      }
      if($nbv!=0 && $nbd!=0) {
        $r = $nbv/$nbd;
      }
      return $r;
    }

    public static function getHistorique($idJ) {
      try {
        $sql = 'SELECT * FROM pfcls_Parties WHERE idJoueur1='.$idJ.' OR idJoueur2='.$idJ.' ORDER BY idPartie DESC LIMIT 10';
        $req = self::$pdo->query($sql);
        return $req->fetchAll(PDO::FETCH_OBJ);
      } catch (PDOException $e) {
        echo $e->getMessage();
        $messageErreur="Erreur lors de la mise à jour du nb de défaite d'un joueur dans la base de données";
      }
    }

    public static function getClassement() {
      $listeJoueurs = Joueur::selectAll();
      $tableau = array();
      foreach ($listeJoueurs as $joueur) {
          $ratio = Joueur::getRatio($joueur->nbV,$joueur->nbD);
          $tableau[$joueur->pseudo] = $ratio;
      }
      arsort($tableau);
      return $tableau;
    }

    public static function premierCoupStats($idJoueur) {
      $data = array('idJoueur'=>$idJoueur);
      $dejaJoue = StatsPerso::selectWhere($data);
      if($dejaJoue == NULL) {
        return array();
      }
      $listeCoupsJoueur="";
      foreach ($dejaJoue as $key => $value) {
        $listeCoupsJoueur .= str_replace(',', '', $value->listeCoups);
      }
      $figureCount = array(
            '1'=>substr_count($listeCoupsJoueur,'1',0,strlen($listeCoupsJoueur)),
            '2'=>substr_count($listeCoupsJoueur,'2',0,strlen($listeCoupsJoueur)),
            '3'=>substr_count($listeCoupsJoueur,'3',0,strlen($listeCoupsJoueur)),
            '4'=>substr_count($listeCoupsJoueur,'4',0,strlen($listeCoupsJoueur)),
            '5'=>substr_count($listeCoupsJoueur,'5',0,strlen($listeCoupsJoueur))
      );
      return $figureCount;
    }

}

?>
