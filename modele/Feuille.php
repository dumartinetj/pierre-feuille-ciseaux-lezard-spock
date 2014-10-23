<?php

require_once 'Figure.php';

class Feuille extends Figure {
	
    public function __construct() { 
		parent::__construct();
		$this->identifiant = 2;
		$this->forces = array(1, 5);
		$this->faiblesses = array(3, 4);
	}
	
}

?>