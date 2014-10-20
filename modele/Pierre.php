<?php

require_once 'Figure.php';

class Pierre extends Figure {

	protected static $identifiant = 1;
	private static $forces = array(3, 4);
    private static $faiblesses = array(2, 5);
	
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