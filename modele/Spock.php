<?php

require_once 'Figure.php';

class Spock extends Figure {
		
	public function __construct() { 
		parent::__construct();
		$this->identifiant = 5;
		$this->forces = array(1, 3);
		$this->faiblesses = array(2, 4);
	}

}

?>