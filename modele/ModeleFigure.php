<?php

abstract class ModeleFigure {

	protected static $image; // pas sur de ça je pense on le mettra direct dans la vue non ?
	protected static $son; // pareil ici
	
	public function __construct() { }
	
	public function estDansSesForces($figure) { // $figure est elle dans les forces de la figure this ?
		return (in_array($figure, $forces));
	}
	
	public function estDansSesFaiblesses() { // $figure est elle dans les faiblesses de la figure this ?
		return (in_array($figure, $faiblesses)); // utile, car si pas dans les forces et pas dans les faiblesses -> draw
	}
	
	public function afficher() {
		echo $this->quiSuisJe();
	}
	
}

?>