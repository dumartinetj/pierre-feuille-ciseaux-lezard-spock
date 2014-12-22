<?php

/*
 * Classe Joueur
 */

require_once 'Modele.php';
require_once 'Jeu.php';

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

}

?>
