<?php

require_once 'ModeleFigure.php';

class ModeleFeuille extends ModeleFigure {

	protected static $image = "LIEN_VERS_LIMAGE";
	protected static $son = "LIEN_VERS_LE_SON";
	private static $forces = array(ModelePierre, ModeleSpock); // je ne suis pas sur du tout de la syntaxe de l'array
    private static $faiblesses = array(ModeleCiseaux, ModeleLezard); // je ne suis pas sur du tout de la syntaxe de l'array
	
	public function __construct() { 
		parent::__construct();
	}

	public function quiSuisJe() {
		return "Feuille";
	}
}

?>