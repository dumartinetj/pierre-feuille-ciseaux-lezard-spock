<?php

require_once 'Figure.php';

class Pierre extends Figure {
	
	public function __construct() { 
		parent::__construct();
		$this->identifiant = 1;
		$this->forces = array(3, 4);
		$this->faiblesses = array(2, 5);
	}

}

?>