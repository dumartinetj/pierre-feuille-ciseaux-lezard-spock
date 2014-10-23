<?php

require_once 'Figure.php';

class Feuille extends Figure {

    protected static $identifiant = 2;
    private static $forces = array(1, 5);
    private static $faiblesses = array(3, 4);
	
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