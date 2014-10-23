<?php

class Coup {

    private $identifiant;
    private $figureJoueur1;
    private $figureJoueur2;
    private $joueur1;
    private $joueur2;
    private $gagnant;
	
    public function __construct($i, $fj1, $fj2, $j1, $j2) {
        $this->identifiant = $i;
        $this->figureJoueur1 = $fj1;
        $this->figureJoueur2 = $fj2;
        $this->joueur1 = $j1; // on suppose au départ que le coup sera un draw
        $this->joueur2 = $j2; // donc j1 & j2 en false
		$this->gagnant = NULL;
    }
	
	// évalue le coup et set le gagnant et le perdant
	

    public function evaluer() {
            $f1 = $this->getFigureJoueur1();
            $f2 = $this->getFigureJoueur2();
            $f1win = $f1->estDansSesForces($f2->getIdentifiant());
            if ($f1win) {
                $this->gagnant = $this->joueur1;				
            }
            else {
                $this->gagnant = $this->joueur2;
            }
    }
	
    public function estUnDraw() {
        $fj1 = $this->figureJoueur1;
        $fj2 = $this->figureJoueur2;
        $id1 = $fj1->getIdentifiant();
        $id2 = $fj2->getIdentifiant();
        return ($id1==$id2); 
    } 
	
    public function getFigureJoueur1() {
        return $this->figureJoueur1;
    }
	
    public function getFigureJoueur2() {
        return $this->figureJoueur2;
    }
    public function getJoueurGagnantCoup(){
        return $this->gagnant;
    }
}
?>