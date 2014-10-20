<?php

require_once 'Figure.php';

class Spock extends Figure {

	protected static $image = "LIEN_VERS_LIMAGE";
	protected static $son = "LIEN_VERS_LE_SON";
	private static $forces = array(Pierre, Ciseaux); // je ne suis pas sur du tout de la syntaxe de l'array
    private static $faiblesses = array(Feuille, Lezard); // je ne suis pas sur du tout de la syntaxe de l'array
	
	
	public function __construct() { 
		parent::__construct();
	}
	
	public static function quiSuisJe() {
		return __CLASS__;
	}

}

?>