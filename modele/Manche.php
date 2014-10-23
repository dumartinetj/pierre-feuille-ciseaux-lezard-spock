<?php

class Manche {

    private $identifiant;
    private $listeCoup; // array de coup : mini un coup -> infinité de coup4
    private $gagnantManche;

    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }

    public function ajoutCoup($c) {
        array_push($this->listeCoup, $c); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
    }

    public function verifFinManche(){
        $lc = end($this->listeCoup);
	if($lc->estUnDraw()){
            return false;
	}
        else{
            return true;
	}
    }
        
    public function getJoueurGagnantManche(){
        $c = end($this->listeCoup);
        $this->gagnantManche = $c->getJoueurGagnantCoup();
        return $this->gagnantManche;
    }

}

?>
