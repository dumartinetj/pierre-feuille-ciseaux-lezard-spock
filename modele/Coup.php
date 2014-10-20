<?php

class Coup {

    private $identifiant;
    private $figureJoueur1;
    private $figureJoueur2;
	private $joueur1;
	private $joueur2;
    private $gagnant;
	
    public function __construct($i, $fj1, $fj2) {
        $this->identifiant = $i;
        $this->figureJoueur1 = $fj1;
        $this->figureJoueur2 = $fj2;
        $this->joueur1 = false; // on suppose au départ que le coup sera un draw
        $this->joueur2 = false; // donc j1 & j2 en false
        $this->gagnant = NULL;
    }
	
	// évalue le coup et set le gagnant et le perdant
	

	public function evaluer() {
		if (!($this->estUnDraw())) { 
			$f1win = $this->getFigureJoueur1().estDansSesForces($this->getFigureJoueur2());
			$f2win = $this->getFigureJoueur1().estDansSesFaiblesses($this->getFigureJoueur2());
			if ($this->f1win == true) {
				$this->joueur1 = true;
                $this->gagnant=$joueur1;
			}
			else if($this->f2win == true) {
				$this->joueur2 = true;
                $this->gagnant=$joueur2;
			}
		}
	}
	
	public function estUnDraw() {
		return ($this->getFigureJoueur1() == $this->getFigureJoueur2());
	}
	
	public function getFigureJoueur1() {
		return $this->figureJoueur1;
	}
	
	public function getFigureJoueur2() {
		return $this->figureJoueur2;
	}
	public function getJoueurGagnant(){
		return $this->gagnant;
    }
}
?>