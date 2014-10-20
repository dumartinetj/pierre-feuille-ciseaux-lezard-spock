<?php

class Jeu {

    private $identifiant;
	private $nbManche; // je sais pas si cet attribut sera utile - doit être impair et sup à 2
	private $joueur;
	
    public function __construct($i, $j1, $nb) {
        $this->identifiant = $i;
        $this->joueur = $j1;
        $this->nbManche = $nb;
    }
	
	// je laisse ça là pour pas l'oublier
	// comment ajouter dans un tableau quand on connait pas le nb d'objets
	// array_push($array, $donnes);
    // ou $array[] = $donnes; pour les objets simples
	// stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
}

?>