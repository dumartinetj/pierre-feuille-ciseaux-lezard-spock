<?php

/*
 * Classe Coup
 */

require_once 'Figure.php';
require_once 'Modele.php';

class Coup extends Modele {

    public static function getIDFigureJoueur1($id) {
        try {
                $req = self::$pdo->prepare("SELECT idFigure1 FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->idFigure1;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération de l'ID de la figure du joueur 1 du coup dans la BDD");
            }
    }

    public static function getIDFigureJoueur2($id) {
        try {
                $req = self::$pdo->prepare("SELECT idFigure2 FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->idFigure2;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération de l'ID de la figure du joueur 2 du coup dans la BDD");
            }
    }

    public static function getIDJoueurGagnantCoup($id){
        try {
                $req = self::$pdo->prepare("SELECT idJoueurGagnant FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->idJoueurGagnant;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération de l'ID du joueur gagnant du coup dans la BDD");
            }
    }

    public static function getIDJoueur1($id){
        try {
                $req = self::$pdo->prepare("SELECT idJoueur1 FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->idJoueur1;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération de l'ID du joueur 1 du coup dans la BDD");
            }
    }

    public static function getIDJoueur2($id){
        try {
                $req = self::$pdo->prepare("SELECT idJoueur2 FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->idJoueur2;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération de l'ID du joueur 2 du coup dans la BDD");
            }
    }

    public static function ajoutCoup($data) {
        try {
                $req = self::$pdo->prepare('INSERT INTO pfcls_Coups (idJoueur1, idJoueur2) VALUES (:idJoueur1, :idJoueur2)');
                $req->execute($data);
                return self::$pdo->lastInsertId(); //retourne le dernier id insérer dans la BDD sur cette session
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de l'insertion d'un coup dans la BDD";
            }
    }

    public static function deleteCoup($id) {
        try {
                $req = self::$pdo->prepare("DELETE FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la supression d'un coup dans la BDD";
            }
    }

    public static function setGagnant($id, $idJGagnant){
        try {
                $req = self::$pdo->prepare("UPDATE pfcls_Coups SET idJoueurGagnant=".$idJGagnant." WHERE idCoup=".$id);
                $req->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la MAJ de l'ID du joueur gagnant du coup dans la BDD");
            }
    }

    public static function evaluer($id) {
            $idF1 = self::getIDFigureJoueur1($id);
            $idF2 = self::getIDFigureJoueur2($id);
            $idJ1 = self::getIDJoueur1($id);
            $idJ2 = self::getIDJoueur2($id);
            $J1Win = Figure::estDansSesForces($idF2,$idF1);
            $J1Win = ($J1Win && Figure::estDansSesFaiblesses($idF1,$idF2));
            if ($J1Win) {
                self::setGagnant($id,$idJ1);
            }
            else {
                self::setGagnant($id,$idJ2);
            }
    }

    public static function estUnDraw($id) {
        $idF1 = self::getIDFigureJoueur1($id);
        $idF2 = self::getIDFigureJoueur2($id);
        return ($idF1 == $idF2);
    }

    public static function retourneIDs($id){ // pour les stats
	     $idF1 = self::getIDFigureJoueur1($id);
       $idF2 = self::getIDFigureJoueur2($id);
	     return $idF1.$idF2;
    }


}

?>
