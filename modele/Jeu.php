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
    
    public static function recherchePartie($nbManches) {
        if(estConnecte()){
            try {
                $idJoueurR=$_SESSION['idJoueur'];
                $req = self::$pdo->prepare('SELECT idJoueur FROM pfcls_parties_en_attente WHERE nbManches= :nbManches AND idJoueur != :idJoueurR');
                $req->execute($nbManches);
                if ($req->rowCount() != 0) {
                    $data_recup = $req->fetch(PDO::FETCH_OBJ);
                }
                else{
                    return false;
                    echo"Pas d'aversaire trouvé!"; //TO DO
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
	// je laisse ça là pour pas l'oublier
	// comment ajouter dans un tableau quand on connait pas le nb d'objets
	// array_push($array, $donnes);
    // ou $array[] = $donnes; pour les objets simples
	// stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
}

?>