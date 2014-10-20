<?php

require_once 'Figure.php';

class Lezard extends Figure {

	protected static $image = "LIEN_VERS_LIMAGE";
	protected static $son = "LIEN_VERS_LE_SON";
	private static $forces = array(Feuille, Spock); // je ne suis pas sur du tout de la syntaxe de l'array
    private static $faiblesses = array(Ciseaux, Pierre); // je ne suis pas sur du tout de la syntaxe de l'array
	
	public function __construct() { 
		parent::__construct();
	}

	public function quiSuisJe() {
		return __CLASS__;
	}
	
}

?>