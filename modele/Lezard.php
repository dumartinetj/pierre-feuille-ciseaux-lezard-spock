<?php

require_once 'Figure.php';

class Lezard extends Figure {
	
	public function __construct() { 
		parent::__construct();
		$this->identifiant = 4;
		$this->forces = array(2, 5);
		$this->faiblesses = array(3, 1);
	}
	
}

?>