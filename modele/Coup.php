<?php

/*
 * Classe Coup
 */

class Coup {

    private $identifiant;
    private $figureJoueur1;
    private $figureJoueur2;
    private $joueur1;
    private $joueur2;
    private $gagnant;

	/*
	 * Constructeur de la classe qui instancie un nouveau Coup
	 */

    public function __construct($i, $fj1, $fj2, $j1, $j2) {
        $this->identifiant = $i;
        $this->figureJoueur1 = $fj1;
        $this->figureJoueur2 = $fj2;
        $this->joueur1 = $j1;
        $this->joueur2 = $j2;
        $this->gagnant = NULL;
    }

	/*
	 * Évalue le coup et set le gagnant et le perdant
	 */
    public function evaluer() {
            $f1 = $this->getFigureJoueur1();
            $f2 = $this->getFigureJoueur2();
            $f1win = $f1->estDansSesForces($f2->getIdentifiant());
            if ($f1win) {
                $this->gagnant = $this->joueur1;
            }
            else {
                $this->gagnant = $this->joueur2;
            }
    }

	/*
	 * Compare les deux figures d'un coup
	 * @return vrai si les figures sont identiques, faux si non
	 */
    public function estUnDraw() {
        $fj1 = $this->figureJoueur1;
        $fj2 = $this->figureJoueur2;
        $id1 = $fj1->getIdentifiant();
        $id2 = $fj2->getIdentifiant();
        return ($id1==$id2);
    }

	/*
	 * Concatene les ids des figures jouées par les 2 joueurs
	 * @return une string contenant les ids des figures
	 */
    public function retourneIDs(){
	     $fj1 = $this->figureJoueur1;
       $fj2 = $this->figureJoueur2;
	     $ids = ($fj1->getIdentifiant()).($fj2->getIdentifiant());
	     return $ids;
    }

    public function getFigureJoueur1() {
        return $this->figureJoueur1;
    }

    public function getFigureJoueur2() {
        return $this->figureJoueur2;
    }

    public function getJoueurGagnantCoup(){
        return $this->gagnant;
    }

    public function getJoueur1(){
        return $this->joueur1;
    }

    public function getJoueur2(){
        return $this->joueur2;
    }
}
?>
