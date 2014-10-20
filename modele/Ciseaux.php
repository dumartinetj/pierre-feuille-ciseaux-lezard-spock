<?php

require_once 'Figure.php';

class Ciseaux extends Figure {

	protected static $identifiant = 3;
	private static $forces = array(2, 4);
    private static $faiblesses = array(5, 1);
	
	public function __construct() { 
		parent::__construct();
	}
	
	public function getIdentifiant() {
		return self::$identifiant;
	}	
	
	public function quiSuisJe() {
		return __CLASS__;
	}
}

?>