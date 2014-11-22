<?php

require_once 'Modele.php';
require_once 'Partie.php';
require_once MODEL_PATH.'Joueur.php'; // connerie de wamp qui ne fait pas la diff entre une min et un maj

class Jeu extends Modele{

    public static function recherchePartie($nbManche) {
        if(estConnecte()){
            try {
                $idJoueurR=$_SESSION['idJoueur'];
                $req = self::$pdo->prepare('SELECT idJoueur FROM pfcls_Parties_en_attente WHERE nbManche= '.$nbManche.' AND idJoueur != '.$idJoueurR);
                $req->execute();
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                    $idAdversaire=$data_recup->idJoueur;
                    return $idAdversaire;
                }
                else{
                    return NULL;
                }
            }catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Échec lors de la recherche d'une partie en attente";
            }
        }
        else{
            $messageErreur="Vous n'êtes pas connecté!";
        }
    }
    public static function checkDejaAttente($idJoueur){
        try {
            $req = self::$pdo->prepare('SELECT * FROM pfcls_Parties_en_attente WHERE idJoueur= '.$idJoueur);
            $req->execute();
            if ($req->rowCount() != 0) {
                return true;
            }
            else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la sélection dans la base de données pour vérifier une partie en attente";
        }
    }

    public static function ajouterAttente($data) {
        if(!Jeu::checkDejaAttente($data['idJoueur'])){
            try {
                $req = self::$pdo->prepare('INSERT INTO pfcls_Parties_en_attente (idJoueur, nbManche) VALUES (:idJoueur, :nbManche) ');
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de l'insertion dans la base de données pour ajouter un partie en attente";
            }
        }
        else{
            $messageErreur="Vous êtes déjà dans la file d'attente.";
        }
    }

    public static function deleteAttente($idJoueur) {
        try {
            $req = self::$pdo->prepare('DELETE FROM pfcls_Parties_en_attente WHERE idJoueur = '.$idJoueur);
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la suppression d'une partie en attente de la base de données";
        }
    }
    
    public static function listeAttente(){
        try {
            $req = self::$pdo->prepare('SELECT j.pseudo, pa.nbManche FROM pfcls_Joueurs j JOIN pfcls_Parties_en_attente pa ON pa.idJoueur=j.idJoueur');
            $req->execute();
            $attente = array();
            while($ligne = $req->fetch(PDO::FETCH_OBJ)){
                array_push($attente, $ligne);
            }
            return $attente;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la séléction de joueur dans la base de données";
        }
    }
}

?>
