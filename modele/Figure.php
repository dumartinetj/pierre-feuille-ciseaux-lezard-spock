<?php

/*
 * Classe Figure
 */

class Figure {

	protected $identifiant;
	/* Liste des forces de la figure */
	protected $forces;
	/* Liste des faiblesses de la figure */
	protected $faiblesses;
	
	/*
	 * Constructeur de la classe qui instancie une nouvelle Figure
	 */

    public function __construct($id) {
		$this->identifiant = $id;
		// remplir $forces et $faiblesses en fonction de $id
	}
	
	/*
	 * Getter de l'identifiant de la figure
	 * @return l'identifiant de la figure
	 */
	public function getIdentifiant() {
		return $this->identifiant;
	}
	
	/*
	 * Retourne le nom de la classe
	 * @return le nom de la classe
	 */	
	public function quiSuisJe() {
		return get_called_class();
	}
	
	/*
	 * Getter des forces de la figure
	 * @return la liste des forces de la figure
	 */
	public function getForces(){
        return $this->forces;
    }
	
	/*
	 * Getter des faiblesses de la figure
	 * @return la liste des faiblesses de la figure
	 */
    public function getFaiblesses(){
        return $this->faiblesses;
    }

	/*
	 * Vérifie si la figure passé en paramètre est dans les forces de la figure
	 * @param l'id de la figure à comparer
	 * @return un booléen, vrai si elle est dans ses forces, faux sinon
	 */
	public function estDansSesForces($idfigure) {
		return in_array($idfigure, $this->forces);
	}
	
	/*
	 * Vérifie si la figure passé en paramètre est dans les forces de la figure
	 * @param l'id de la figure à comparer
	 * @return un booléen, vrai si elle est dans ses faiblesses, faux sinon
	 */
	public function estDansSesFaiblesses($idfigure) {
		return in_array($idfigure, $this->faiblesses);
	}
	
}

?>