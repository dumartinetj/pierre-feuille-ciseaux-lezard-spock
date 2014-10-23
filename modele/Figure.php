<?php

abstract class Figure {

	protected static $identifiant = 0;
        private static $forces = array(0,0);
        private static $faiblesses = array(0,0);
        public function __construct() { }
	
	public function estDansSesForces($idfigure) { // $figure est elle dans les forces de la figure this ?
		return (in_array($idfigure, self::getForces()));
	}
	
	public function estDansSesFaiblesses($idfigure) { // $figure est elle dans les faiblesses de la figure this ?
		return (in_array($idfigure, self::getFaiblesses())); // utile, car si pas dans les forces et pas dans les faiblesses -> draw
	}
	
	public function getIdentifiant() {
		return self::$identifiant;
	}
	
	public function afficher(){
		return $this->quiSuisJe();
	}
	public function getForces(){
            return self::$forces;
        }
        public function getFaiblesses(){
            return self::$faiblesses;
        }
}

?>