<?php

require_once 'Figure.php';

class Ciseaux extends Figure {
	
	public function __construct() { 
		parent::__construct();
		$this->identifiant = 3;
		$this->forces = array(2, 4);
		$this->faiblesses = array(5, 1);
	}

}

?>