<?php

/*
 * Classe Coup
 */

require_once 'Figure.php';
require_once 'Modele.php';

class Coup extends Modele {

    public static function getCoup($id) {
        try {
                $req = self::$pdo->prepare("SELECT * FROM pfcls_Coups WHERE idCoup=".$id);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération du coup dans la BDD");
            }
    }

    public static function getDernierCoup($data) {
        try {
                $req = self::$pdo->prepare("SELECT MAX(idCoup) AS id FROM pfcls_Coups WHERE idJoueur1 = :idJoueur1 AND idJoueur2 = :idJoueur2");
                $req->execute($data);
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->id;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération du coup dans la BDD");
            }
    }

    public static function getDernierCoupNul($data) {
        try {
                $req = self::$pdo->prepare("SELECT MAX(idCoup) AS id FROM pfcls_Coups WHERE idJoueur1 = :idJoueur1 AND idJoueur2 = :idJoueur2 AND idFigure1 IS NULL AND idFigure2 IS NULL AND idJoueurGagnant IS NULL");
                $req->execute($data);
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->id;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                die("Erreur lors de la récupération du coup dans la BDD");
            }
    }

    public static function getIDFigureJoueur1($id) {
        try {
                $req = self::$pdo->prepare("SELECT * FROM pfcls_Coups WHERE idCoup=".$id);
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
                $req = self::$pdo->prepare("SELECT * FROM pfcls_Coups WHERE idCoup=".$id);
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
                $req = self::$pdo->prepare('INSERT INTO pfcls_Coups (idJoueur1, idJoueur2, idManche) VALUES (:idJoueur1, :idJoueur2, :idManche)');
                $req->execute($data);
                return self::$pdo->lastInsertId(); //retourne le dernier id insérer dans la BDD sur cette session
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de l'insertion d'un coup dans la BDD";
            }
    }

    public static function whoUpdateCoup($data) {
        try {
                $req = self::$pdo->prepare("SELECT MAX(idCoup) AS id FROM pfcls_Coups WHERE idJoueur2= :idJoueur2 AND idFigure2 IS NULL");
                $req->execute($data);
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    return $data_recup->id;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de who MAJ d'un coup dans la BDD";
            }
    }

    public static function updateCoup($data) {
        try {
                reset($data); // remettre le pointeur interne du tableau au début, on ne sait jamais
                $cle = key($data);
                $sql = "UPDATE pfcls_Coups SET ".$cle."=:".$cle." WHERE idCoup = :idCoup";
                $req = self::$pdo->prepare($sql);
                $req->execute($data);

            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la MAJ d'un coup dans la BDD";
            }
    }

    public static function checkCoupPretAEvaluer($idC) {
        try {
                $req = self::$pdo->prepare("SELECT * FROM pfcls_Coups WHERE idCoup = ".$idC." AND (idFigure1 IS NULL OR idFigure2 IS NULL)");
                $req->execute();
                return ($req->rowCount() == 0);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de check evaluation d'un coup dans la BDD";
            }
    }

    public static function checkCoupEstEvaluer($idC) {
        try {
                $req = self::$pdo->prepare("SELECT * FROM pfcls_Coups WHERE idCoup = ".$idC." AND idJoueurGagnant IS NOT NULL");
                $req->execute();
                return ($req->rowCount() == 0);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de check evaluation 2 d'un coup dans la BDD";
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
