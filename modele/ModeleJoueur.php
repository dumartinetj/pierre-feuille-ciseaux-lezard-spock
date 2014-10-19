<?php

class ModeleJoueur {

    private $identifiant;
    private $pseudo;
    private $sexe; // doit être seulement Homme ou Femme
	private $age; // compris entre 0 et 100 ?
	private $nbVictoire;
	private $nbDefaite;
	private $ratio;	
	
    public function __construct($i, $p, $s, $a) {
        $this->identifiant = $i;
        $this->pseudo = $p;
        $this->sexe = $s;
		$this->age = $a;
		$this->nbVictoire = 0;
		$this->nbDefaite = 0;		
		$this->ratio = 0;
    }
}

?>