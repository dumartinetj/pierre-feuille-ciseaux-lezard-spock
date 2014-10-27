<?php

/*
 * Classe Manche
 */

class Manche {

    private $identifiant;
    private $listeCoup;
    private $gagnantManche;
	
	/*
	 * Constructeur de la classe qui instancie une nouvelle Manche
	 */
    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }
	
	/*
	 * Ajoute le coup passé en paramètre à listeCoup de this
	 * @param $c le coup à ajouter
	 */
    public function ajoutCoup($c) {
        array_push($this->listeCoup, $c); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
    }
        
	/*
	 * Set et retourne le gagnant de this
	 * @return le gagnant de la partie
	 */
    public function getJoueurGagnantManche(){
        $c = end($this->listeCoup);
        $this->gagnantManche = $c->getJoueurGagnantCoup();
        return $this->gagnantManche;
    }

}

?>
