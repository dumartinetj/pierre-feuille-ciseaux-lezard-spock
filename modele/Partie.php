<?php

class Partie {

    private $identifiant;
	private $nbManche; // je sais pas si cet attribut sera utile - doit être impair et sup à 2
	private $joueur1;
    private $joueur2;
    private $listeManche; // array de manches : mini une manche -> nb de manche set	
    private $gagnantPartie;
	
    public function __construct($i, $j1, $j2) {
        $this->identifiant = $i;
        $this->joueur1 = $j1;
        $this->joueur2 = $j2;
        $this->listeManche = array();
    }
	
	public function ajoutManche($m) {
		array_push($this->listeManche, $m); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
	}
	
	public function estGagnantPartie(){
	if (listeManche(1).getGagnantManche()==listeManche(2).getGagnantManche()){
	          gagnantPartie=listeManche(1).getGagnantManche();
	}
	else{ ajoutManche(new Manche(3));
		gagnantPartie=listeManche(3).getGagnantManche();
	}
}

?>
