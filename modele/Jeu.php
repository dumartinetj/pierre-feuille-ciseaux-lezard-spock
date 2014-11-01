<?php

require_once 'Modele.php';

class Jeu extends Modele{

    private $identifiant;
	private $nbManche; // je sais pas si cet attribut sera utile - doit être impair et sup à 2
	private $joueur;

    public function __construct($i, $j1, $nb) {
        $this->identifiant = $i;
        $this->joueur = $j1;
        $this->nbManche = $nb;
    }

    public static function recherchePartie($nbManche) {
        if(estConnecte()){
            try {
                $idJoueurR=$_SESSION['idJoueur'];
                $req = self::$pdo->prepare('SELECT idJoueur FROM pfcls_parties_en_attente WHERE nbManche= '.$nbManche.' AND idJoueur != '.$idJoueurR);
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
                $messageErreur="Échec lors de la recherche d'une partie";
            }
        }
        else{
            $messageErreur="Vous n'êtes pas connecté!";
        }
    }
    public static function checkDejaAttente($idJoueur){
        try {
            $req = self::$pdo->prepare('SELECT * FROM pfcls_parties_en_attente WHERE idJoueur= '.$idJoueur);
            $req->execute();
            if ($req->rowCount() != 0) {
                return true;
            }
            else{
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de l'insertion dans la base de données pour inscription";
        }
    }

    public static function ajouterAttente($data) {
        if(!Jeu::checkDejaAttente($data['idJoueur'])){
            try {
                $req = self::$pdo->prepare('INSERT INTO pfcls_parties_en_attente (idJoueur, nbManche) VALUES (:idJoueur, :nbManche) ');
                $req->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de l'insertion dans la base de données pour inscription";
            }
        }
        else{
            $messageErreur="Vous êtes déjà dans la file d'attente.";
        }
    }

    public static function deleteAttente($idJoueur) {
        try {
            $req = self::$pdo->prepare('DELETE FROM pfcls_parties_en_attente WHERE idJoueur = '.$idJoueur);
            $req->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            $messageErreur="Erreur lors de la suppression d'une partie en attente de la base de données";
        }
    }
	// je laisse ça là pour pas l'oublier
	// comment ajouter dans un tableau quand on connait pas le nb d'objets
	// array_push($array, $donnes);
    // ou $array[] = $donnes; pour les objets simples
	// stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
}

?>
