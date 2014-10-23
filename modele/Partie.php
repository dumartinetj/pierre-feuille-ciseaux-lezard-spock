<?php

class Partie {

    private $identifiant;
    private $nbManche; // je sais pas si cet attribut sera utile - doit être impair et sup à 2 
    private $joueur1;
    private $joueur2;
    private $listeManche; // array de manches : mini une manche -> nb de manche set	
    private $gagnantPartie=NULL;
	
    public function __construct($i, $nb, $j1, $j2) {
        $this->identifiant = $i;
        $this->joueur1 = $j1;
        $this->joueur2 = $j2;
        $this->nbManche = $nb;
        $this->listeManche = array();
    }
	
	// nom: ajoutManche
	// description: ajout la manche placé en paramètre à la listeManche de la Partie courante
	// param: $m une Manche
	// retourne: rien
    public function ajoutManche($m) {
        array_push($this->listeManche, $m);
    }
	
	// vérifie si le partie est finie, true si c'est le cas, false sinon
	// on doit d'abord vérifier si on un gagnant donc on check un des joueurs à gagner ($nbmanche/2)+1 fois
	// si c'est pas le cas, on doit vérifier si dans liste de manche on a $nbmanche éléments
	
	// nom: getJoueurGagnantPartie
	// description: renvoie le gagnant de la partie 
	// param: rien
	// retourne: le joueur qui a gagner la partie
   public function getJoueurGagnantPartie(){
        $nbwinJ1=0;$nbwinJ2=0;
        $jgm=end($this->listeManche)->getJoueurGagnantManche();
        if($jgm==$this->joueur1){$nbwinJ1++;}
        elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        while(prev($this->listeManche)!=FALSE){
            $jgm=current($this->listeManche)->getJoueurGagnantManche();
            if($jgm==$this->joueur1){$nbwinJ1++;}
            elseif ($jgm==$this->joueur2) {$nbwinJ2++;}
        }
        $nbMancheMini=$this->nbManche/2;
        if(($nbwinJ1>$nbwinJ2)and($nbwinJ1>$nbMancheMini)){$this->gagnantPartie=$this->joueur1;}
        elseif (($nbwinJ1<$nbwinJ2)and($nbwinJ2>$nbMancheMini)) {$this->gagnantPartie=$this->joueur2;}
        return $this->gagnantPartie;
    }
    
	// nom: checkPartieFinie
	// description: vérifie si la partie est finie
	// param: rien
	// retourne: true si la partie est finie et false si non
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
