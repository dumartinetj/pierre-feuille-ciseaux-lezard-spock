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
	
	// nom: estDansSesForces
	// description: vérifie si la figure placé en paramètre est dans les forces de la figure sur laquelle on vérifie
	// param: la figure adverse
	// retourne: true si elle est dans ses forces, false si non 
	public function estDansSesForces($idfigure) {
		return in_array($idfigure, $this->forces);
	}
	
	// nom: estDansSesFaiblesses
	// description: vérifie si la figure placé en paramètre est dans les faiblesses de la figure sur laquelle on vérifie
	// param: la figure adverse
	// retourne: true si elle est dans ses faiblesses, false si non 
	public function estDansSesFaiblesses($idfigure) {
		return in_array($idfigure, $this->faiblesses);
	}
	
}

?>