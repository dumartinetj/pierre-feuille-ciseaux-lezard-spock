<?php

class abstract ModeleCoup {

    private $identifiant;
    private $figureJoueur1;
    private $figureJoueur2;
	
    public function __construct($i, $fj1, $fj2) {
        $this->identifiant = $i;
        $this->figureJoueur1 = $fj1;
        $this->figureJoueur2 = $fj2;
    }
}

?>