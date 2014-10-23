<?php

class Manche {

    private $identifiant;
    private $listeCoup; // array de coup : mini un coup -> infinité de coup
    private $gagnantManche;

    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }
    // On ajoute le dernier coup jouer à la liste des coups qu'il soit "draw" ou gagnant.
    public function ajoutCoup($c) {
        array_push($this->listeCoup, $c); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
    }
        
    //On cherche a connaître le joueur qui a gagné la manche, donc on se positionne à la fin de la liste des coups, 
    //le dernier coup jouer est forcément gagnant (tous les autres sont "draw" ou il n'y a aucun coups précédents) 
    //donc on recherche le get le joueur qui a gagné le dernier coup.
    public function getJoueurGagnantManche(){
        $c = end($this->listeCoup);
        $this->gagnantManche = $c->getJoueurGagnantCoup();
        return $this->gagnantManche;
    }

}

?>
