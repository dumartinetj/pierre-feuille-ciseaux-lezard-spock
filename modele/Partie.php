<?php

class Partie {

    private $identifiant;
	private $nbManche; // je sais pas si cet attribut sera utile - doit être impair et sup à 2
	private $joueur1;
    private $joueur2;
    private $listeManche; // array de manches : mini une manche -> nb de manche set	
    private $gagnantPartie;
	
    public function __construct($i, $nb, $j1, $j2) {
        $this->identifiant = $i;
        $this->joueur1 = $j1;
        $this->joueur2 = $j2;
        $this->nbManche = $nb;
        $this->listeManche = array();
    }
	
    public function ajoutManche($m) {
        array_push($this->listeManche, $m);
    }
	
	// vérifie si le partie est finie, true si c'est le cas, false sinon
	// on doit d'abord vérifier si on un gagnant donc on check un des joueurs à gagner ($nbmanche/2)+1 fois
	// si c'est pas le cas, on doit vérifier si dans liste de manche on a $nbmanche éléments
	
	public function checkPartieFini() {
		// todo
	}
	
    /*public function estGagnantPartie(){
        end($listeManche);
        if ($this->getJoueurGagnantManche(end($listeManche))==$this->getJoueurGagnantManche(prev(end($listeManche)))){
            $gagnantPartie=$this->getJoueurGagnantManche(current($listeManche));
        }
        else { 
            $gagnantPartie=$this->getJoueurGagnantManche(prev(prev(end($listeManche))));
        }
    }*/
}

?>
