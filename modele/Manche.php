<?php

class Manche {

    private $identifiant;
    private $listeCoup; // array de coup : mini un coup -> infinité de coup
    private $gagnantManche;

    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }
	
	// nom: ajoutCoup
	// description: ajout le coup placé en paramètre à la listeCoup de la manche courante 
	// param: $c un Coup
	// retourne: rien
    public function ajoutCoup($c) {
        array_push($this->listeCoup, $c); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
    }
        
    // nom: getJoueurGagnantManche
	// description: place le dernier coup jouer dans une variable et place dans la variable gagnantManche le joueur gagnant du coup
	// param: rien
	// retourne: la variable gagnantManche
    public function getJoueurGagnantManche(){
        $c = end($this->listeCoup);
        $this->gagnantManche = $c->getJoueurGagnantCoup();
        return $this->gagnantManche;
    }

}

?>
