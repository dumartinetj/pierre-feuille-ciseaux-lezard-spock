<?php

abstract class Figure {

	protected $identifiant;
	protected $forces;
	protected $faiblesses;

    public function __construct() {}
	
	
	public function getIdentifiant() {
		return $this->identifiant;
	}
	
	public function quiSuisJe() {
		return get_called_class();
	}
	
	public function getForces(){
        return $this->forces;
    }
	
    public function getFaiblesses(){
        return $this->faiblesses;
    }
	
	public function estDansSesForces($idfigure) {
		return in_array($idfigure, $this->forces);
	}
	
	public function estDansSesFaiblesses($idfigure) {
		return in_array($idfigure, $this->faiblesses);
	}
	
}

?>