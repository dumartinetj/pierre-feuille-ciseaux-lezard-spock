<?php

require_once 'Figure.php';

class Spock extends Figure {

	protected static $identifiant = 5;
	private static $forces = array(1, 3);
    private static $faiblesses = array(2, 4);
		
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