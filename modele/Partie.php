<?php

/*
 * Classe Partie
 */

class Partie {

    private $identifiant;
    private $nbManche;
    private $joueur1;
    private $joueur2;
    private $listeManche;	
    private $gagnantPartie;
	
	/*
	 * Constructeur de la classe qui instancie une nouvelle Partie
	 */
	
    public function __construct($i, $nb, $j1, $j2) {
        $this->identifiant = $i;
        $this->joueur1 = $j1;
        $this->joueur2 = $j2;
        $this->nbManche = $nb;
        $this->listeManche = array();
        $this->gagnantPartie = NULL;
    }
	
	/*
	 * Ajoute la manche passé en paramètre à listeManche de this
	 * @param $m la manche à ajouter
	 */
    public function ajoutManche($m) {
        array_push($this->listeManche, $m);
    }
	
	/*
	 * Set et retourne le gagnant de this
	 * @return le gagnant de la partie
	 */
   public function getJoueurGagnantPartie(){
        $nbwinJ1=0;$nbwinJ2=0;
        foreach($this->listeManche as $lmanche){ //CHECK
            $jgm=$lmanche->getJoueurGagnantManche();
            if($jgm==$this->joueur1){$nbwinJ1++;}
            elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        }
        /*
        $jgm=end($this->listeManche)->getJoueurGagnantManche();
        if($jgm==$this->joueur1){$nbwinJ1++;}
        elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        while(prev($this->listeManche)!=FALSE){
            $jgm=current($this->listeManche)->getJoueurGagnantManche();
            if($jgm==$this->joueur1){$nbwinJ1++;}
            elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        }*/
        $nbMancheMini=$this->nbManche/2;
        if(($nbwinJ1>$nbwinJ2)and($nbwinJ1>$nbMancheMini)){$this->gagnantPartie=$this->joueur1;}
        elseif (($nbwinJ1<$nbwinJ2)and($nbwinJ2>$nbMancheMini)) {$this->gagnantPartie=$this->joueur2;}
        return $this->gagnantPartie;
    }
    
	/*
	 * Vérifie si la partie est terminée
	 * @return vraie si la partie est finie, faux sinon
	 */
    public function checkPartieFinie() {
	$nbmjoue=count($this->listeManche);
        $unGagnant=FALSE;
        if($nbmjoue>=1){
            $winner=$this->getJoueurGagnantPartie();
            $unGagnant=($winner!=NULL);
        }
        return (($this->nbManche==$nbmjoue) or $unGagnant);
    }
}

?>
