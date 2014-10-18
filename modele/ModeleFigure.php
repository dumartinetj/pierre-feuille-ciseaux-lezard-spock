<?php

class abstract ModeleFigure {

    private $identifiant;
    private $nom;
    private $image;
	private $son;
	
    public function __construct($i, $n, $i, $s) {
        $this->identifiant = $i;
        $this->nom = $n;
        $this->image = $i;
		$this->son = $s;
    }
}

?>