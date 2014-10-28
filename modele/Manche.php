<?php

/*
 * Classe Manche
 */
 
require_once 'Modele.php';

class Manche extends Modele{

    private $identifiant;
    private $listeCoup;
    private $gagnantManche;

	/*
	 * Constructeur de la classe qui instancie une nouvelle Manche
	 */
    public function __construct($i) {
        $this->identifiant = $i;
        $this->listeCoup = array();
    }

	/*
	 * Ajoute le coup passé en paramètre à listeCoup de this
	 * @param $c le coup à ajouter
	 */
    public function ajoutCoup($c) {
        array_push($this->listeCoup, $c); // aide sur stackoverflow : http://stackoverflow.com/questions/5385433/how-to-create-an-empty-array-in-php-with-predefined-size
    }

	/*
	 * Set et retourne le gagnant de this
	 * @return le gagnant de la manche
	 */
    public function getJoueurGagnantManche(){
        $c = end($this->listeCoup);
        $this->gagnantManche = $c->getJoueurGagnantCoup();
        return $this->gagnantManche;
    }

  /*
   * Get l'id du joueur 1 de this
   * @return l'id du joueur 1 de this
   */
    public function getIdJoueur1(){
        $c = end($this->listeCoup);
        $j1 = $c->getJoueur1();
        return $j1->getIdentifiant();
    }

  /*
   * Get l'id du joueur 2 de this
   * @return l'id du joueur 2 de this
   */
   public function getIdJoueur2(){
      $c = end($this->listeCoup);
      $j1 = $c->getJoueur2();
      return $j1->getIdentifiant();
  }

  /*
   * Retourne la chaine de caractère correspondant à liste des coup de la manche this
   * @return retourne la chaine de caractère
   */
   public function parsageListeCoups() {
        $chaineListeCoup = "";
        foreach ($this->listeCoup as $coup) {
			$chaineListeCoup .= $coup->retourneIDs();
			$chaineListeCoup .= ",";
		}
        $chaineListeCoup=rtrim($chaineListeCoup,",");
        return $chaineListeCoup;
   }

  public function ajoutStatsGlobales(){
      try {
		 $data = array(
            'idJoueur1' => $this->getIdJoueur1(),
            'idJoueur2' => $this->getIdJoueur2(),
            'listeCoups' => $this->parsageListeCoups()
        );
         $req = self::$pdo->prepare('INSERT INTO pfcls_StatistiquesGlobales (idJoueur1, idJoueur2, listeCoups) VALUES (:idJoueur1, :idJoueur2, :listeCoups)');
         $req->execute($data);
         return self::$pdo->lastInsertId();
      } catch (PDOException $e) {
          echo $e->getMessage();
          die("Erreur lors de l'insertion des stats globales dans la BDD");
      }

  }

}

?>
