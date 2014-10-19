<?php

class abstract ModeleCoup {

    private $identifiant;
    private $figureJoueur1;
    private $figureJoueur2;
	private $joueur1;
	private $joueur2;
	
    public function __construct($i, $fj1, $fj2) {
        $this->identifiant = $i;
        $this->figureJoueur1 = $fj1;
        $this->figureJoueur2 = $fj2;
        $this->joueur1 = false; // on suppose au départ que le coup sera un draw
        $this->joueur2 = false; // donc j1 & j2 en false
    }
	
	// évalue le coup et set le gagnant et le perdant
	
	public function eval() {
		if ($this.estUnDraw()) { 	// pas sur de la syntaxe
			$f1win = $this->figureJoueur1.estDansSesForces($this->figureJoueur2);
			$f2win = $this->figureJoueur1.estDansSesFaiblesses($this->figureJoueur1);
			if ($this->f1win == true) {
				$this->joueur1 = true;
			}
			else if($this->f2win == true) {
				$this->joueur2 = true;
			}
		}
	}
	
	public function estUnDraw() {
		return ($this->figureJoueur1 == $this->figureJoueur2);
	}
}

?>