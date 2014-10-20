<?php

require_once 'Figure.php';

class Lezard extends Figure {

	protected static $identifiant = 4;
	private static $forces = array(2, 5);
    private static $faiblesses = array(3, 1);
	
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