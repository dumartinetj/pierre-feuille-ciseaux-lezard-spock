<?php

class ModeleManche {

    private $identifiant;
    private $listeCoup; // array de coup : mini un coup -> infinité de coup
	
    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }
	
	// je laisse ça là pour pas l'oublier
	// comment ajouter dans un tableau quand on connait pas le nb d'objets
	// array_push($array, $donnes);
    // ou $array[] = $donnes; pour les objets simples
	// stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
}

?>